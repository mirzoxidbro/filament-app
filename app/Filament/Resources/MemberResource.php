<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Filament\Resources\MemberResource\RelationManagers;
use App\Filament\Resources\MemberResource\RelationManagers\TeamRelationManager;
use App\Models\Member;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nickname')
                ->minLength(4)
                ->required()
                ->maxLength(20),
                TextInput::make('birth_date')
                ->minLength(4)
                ->maxLength(20),
                TextInput::make('region')
                ->minLength(4)
                ->maxLength(20),
                TextInput::make('dagree')
                ->minLength(4)
                ->maxLength(20),
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
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            TeamRelationManager::class
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }    
}
