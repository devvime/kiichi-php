<?php

$url = 'http://localhost:8080';

test('Register new user', function() use($url) {
    $res = post("{$url}/register", [
        "name"=>"Test user",
        "email"=>"user@test.com",
        "password"=>"test_password"
    ]);
    $user = json_decode($res, true);
    expect($user['status'])->toBe(200);
    $registeredUser = end($user['data']);
    expect($registeredUser['email'])->toBe('user@test.com');
    session_start();
    $_SESSION['globalRegisteredId'] = $registeredUser['id'];
});

test('User Login', function() use($url) {
    $res = post("{$url}/auth", [
        "email"=>"user@test.com",
        "password"=>"test_password"
    ]);
    $res = json_decode($res, true);
    expect($res['status'])->toBe(200);
    expect($res['token'])->toBeString();
    $_SESSION['globalToken'] = $res['token'];
});

test('Create new user', function() use($url) {
    $res = post("{$url}/user", [
        "name"=>"Test user",
        "email"=>"new_user@test.com",
        "password"=>"test_password"
    ], $_SESSION['globalToken']);
    $user = json_decode($res, true);
    expect($user['status'])->toBe(200);
    expect(end($user['data'])['email'])->toBe('new_user@test.com');
    $_SESSION['globalId'] = end($user['data'])['id'];
});

test('Get all users', function() use($url) {
    $res = get("{$url}/user", $_SESSION['globalToken']);
    $users = json_decode($res, true);
    expect($users['status'])->toBe(200); 
});

test('Update user', function() use($url) {
    $res = put("{$url}/user/{$_SESSION['globalId']}", [
        "name"=>"Test user updated",
        "email"=>"user.updated@test.com",
        "password"=>"test_password_updated"
    ], $_SESSION['globalToken']);
    $user = json_decode($res, true);
    expect($user['status'])->toBe(200); 
});

test('Find user by id', function() use($url) {
    $res = get("{$url}/user/{$_SESSION['globalId']}", $_SESSION['globalToken']);
    $user = json_decode($res, true);
    expect($user['status'])->toBe(200); 
});

test('Delete user', function() use($url) {
    $res = delete("{$url}/user/{$_SESSION['globalId']}", $_SESSION['globalToken']);
    $user = json_decode($res, true);
    expect($user['status'])->toBe(200); 
});

test('Delete test user', function() use($url) {
    $res = delete("{$url}/user/{$_SESSION['globalRegisteredId']}", $_SESSION['globalToken']);
    $user = json_decode($res, true);
    unset($_SESSION['globalId']);
    unset($_SESSION['globalToken']);
    unset($_SESSION['globalRegisteredId']);
    session_destroy();
    expect($user['status'])->toBe(200); 
});