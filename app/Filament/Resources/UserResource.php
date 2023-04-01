<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form {
        return $form
            ->schema([
                Card::make()
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Toggle::make('is_admin')
                        ->required(),
                    TextInput::make('email')
                        ->email()
                        ->unique(ignoreRecord: true)
                        ->required()
                        ->maxLength(255),
                    CheckboxList::make('roles')
                        ->relationship('roles', 'name')
                        ->columns(2)
                        ->helperText('Only Choose One!')
                        ->required()
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                BooleanColumn::make('is_admin'),
                TextColumn::make('roles.name')->searchable()->sortable(),
                TextColumn::make('email'),
                TextColumn::make('updated_at')->date('d-m-y')
            ])
            ->filters([

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
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }    
}
