<?php

namespace App\Models;

use App\Models\Comment;
use samuelsihotang1\LaravelVote\Traits\Voter;
use Overtrue\LaravelFollow\Traits\Followable;
use Overtrue\LaravelFollow\Traits\Follower;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use HasFactory, Notifiable, Follower, Followable, Voter;


  protected static function booted()
  {
    static::creating(function ($user) {
      $user->name_slug = strtolower(str_replace(' ', '-', $user->name));
      $user->avatar = 'https://ui-avatars.com/api/?name=' . $user->name . '&background=868e96&color=fff';
    });
  }
  protected $guarded = [];

  protected $hidden = [
    'password',
    'remember_token',
  ];

  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function getContents()
  {

    $questions = $this->questions()->latest()->get();
    $answers = $this->answers()->latest()->get();

    return $questions->merge($answers);
  }

  public function questions()
  {
    return $this->hasMany(Question::class);
  }

  public function answers()
  {
    return $this->hasMany(Answer::class);
  }

  public function employment()
  {
    return $this->hasOne(Employment::class);
  }

  public function education()
  {
    return $this->hasOne(Education::class);
  }

  public function location()
  {
    return $this->hasOne(Location::class);
  }

  public function topics()
  {
    return $this->belongsToMany(Topic::class, 'user_topics');
  }

  public function report_questions()
  {
    return $this->belongsToMany(Question::class, 'report_questions');
  }

  public function report_answers()
  {
    return $this->belongsToMany(Answer::class, 'report_answers');
  }

  public function report_comments()
  {
    return $this->belongsToMany(Comment::class, 'report_comments');
  }
}