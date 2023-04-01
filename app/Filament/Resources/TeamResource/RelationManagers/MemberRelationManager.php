<?php

namespace App\Filament\Resources\TeamResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PHPUnit\Logging\TestDox\PlainTextRenderer;
use Symfony\Component\Console\Input\InputOption;
use Filament\Forms\Components\Textarea;

class MemberRelationManager extends RelationManager
{
    protected static string $relationship = 'members';

    protected static ?string $recordTitleAttribute = 'nickname';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nickname')
                    ->required()
                    ->maxLength(255),
                TextInput::make('birth_date')
                    ->required()
                    ->maxLength(255),
                TextInput::make('region')
                    ->required()
                    ->maxLength(30),
                TextArea::make('dagree')
                    ->rows(10)
                    ->columns(25),
                TextInput::make('updated_at')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nickname'),
                TextColumn::make('birth_date'),
                TextColumn::make('region'),
                TextColumn::make('dagree'),
                TextColumn::make('updated_at'),
                TextColumn::make('user_id'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }    
}
