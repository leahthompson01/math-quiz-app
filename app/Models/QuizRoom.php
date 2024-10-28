<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'current_players_in_room',
        'submitted_answers',
        'created_by',
        'quiz'
    ];
//

    protected function casts(): array
    {
        return [
            'current_players_in_room' => 'array',
            'submitted_answers' => 'array',
        ];
    }

    // playersQuizAnswers, isQuizSubmitted, playerProblemIndex
//[{ playerID => [userID, playerName, socket]}]
}