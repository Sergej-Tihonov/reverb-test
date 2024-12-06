<?php

namespace App\Filament\Resources;

use App\Enums\TalkLength;
use App\Enums\TalkStatus;
use App\Filament\Resources\TalkResource\Pages;
use App\Models\Talk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class TalkResource extends Resource
{
    protected static ?string $model = Talk::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Second Group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('speaker_id')
                    ->relationship('speaker', 'name')
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\Textarea::make('abstract')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Checkbox::make('new_talk')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->persistFiltersInSession()
            ->filtersTriggerAction(fn ($action) => $action->button()->label('filters'))
            ->columns([
                Tables\Columns\ImageColumn::make('speaker.avatar')
                    ->label('avatar')
                    ->circular()
                    ->defaultImageUrl(function (Talk $record) {
                        return 'https://ui-avatars.com/api/?background=0D8ABC&color=fff&name='.urlencode($record->speaker->name);
                    }),
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable()
                    ->description(fn (Talk $record): string => str($record->abstract)->limit(40)),
                Tables\Columns\TextInputColumn::make('speaker.name')
                    ->rules(['required', 'string', 'max:255'])
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('abstract')
                    ->wrap(),
                Tables\Columns\IconColumn::make('new_talk')->boolean(),
                Tables\Columns\ToggleColumn::make('new_talk'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->sortable()
                    //->color(fn (Talk $record):string => $record->status->getColor()),
                    ->color(function (TalkStatus $state) {
                        return $state->getColor();
                    }),
                Tables\Columns\IconColumn::make('length')
                    ->icon(function (TalkLength $state) {
                        return match ($state) {
                            TalkLength::NORMAL => 'heroicon-o-megaphone',
                            TalkLength::LIGHTNING => 'heroicon-o-bolt',
                            TalkLength::KEYNOTE => 'heroicon-o-key',
                        };
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('new_talk'),
                Tables\Filters\SelectFilter::make('speaker')
                    ->relationship('speaker', 'name')
                    ->multiple()
                    ->searchable()
                    ->preload(),
                Tables\Filters\Filter::make('has_avatar')
                    ->query(function ($query) {
                        return $query->whereHas('speaker', function (Builder $query) {
                            $query->whereNotNull('avatar');
                        });
                    })
                    ->label('show only speakers with avatar')
                    ->toggle(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver(),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('approve')
                        ->visible(function (Talk $record) {
                            return $record->status !== TalkStatus::APPROVED;
                        })
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function (Talk $record) {
                            $record->approve();
                        })
                        ->after(function () {
                            Notification::make()
                                ->success()
                                ->duration(1000) // 1sec
                                ->title('Talk is approved!')
                                ->body('The speaker has been notified of this talk.')
                                ->send();
                        }),
                    Tables\Actions\Action::make('reject')
                        ->visible(function (Talk $record) {
                            return $record->status !== TalkStatus::REJECTED;
                        })
                        ->icon('heroicon-o-no-symbol')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(function (Talk $record) {
                            $record->reject();
                        })
                        ->after(function () {
                            Notification::make()
                                ->danger()
                                ->duration(1000) // 1sec
                                ->title('Talk is rejected!')
                                ->body('The speaker has been notified of this talk.')
                                ->send();
                        }),
                ])->label('more'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('approve')
                        ->action(function (Collection $records) {
                            $records->each->approve();
                        }),
                ]),
            ])
            ->headerActions([
                Tables\Actions\Action::make('export')
                    ->tooltip('This will export all records visible in the table. Adjust filters to export a subset of records.')
                    ->action(function ($livewire) {
                        ray($livewire->getFilteredTableQuery()->count());
                        ray('Exporting talks');
                    }),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTalks::route('/'),
            'create' => Pages\CreateTalk::route('/create'),
            // 'edit' => Pages\EditTalk::route('/{record}/edit'),
        ];
    }
}
