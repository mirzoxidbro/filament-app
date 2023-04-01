<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\RelationManagers\TeamRelationManager;
use App\Filament\Resources\TeamResource\Pages;
use App\Filament\Resources\TeamResource\RelationManagers;
use App\Filament\Resources\TeamResource\RelationManagers\MemberRelationManager;
use App\Models\Team;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->minLength(4)
                ->maxLength(20),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('updated_at')
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
            MemberRelationManager::class
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeam::route('/create'),
            'edit' => Pages\EditTeam::route('/{record}/edit'),
        ];
    }    
}
