<?php

test('Register new user', function () {
    $res = post('http://localhost:8080/register', [
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

test('User Login', function () {
    $res = post('http://localhost:8080/auth', [
        "email"=>"user@test.com",
        "password"=>"test_password"
    ]);
    $res = json_decode($res, true);
    expect($res['status'])->toBe(200);
    expect($res['token'])->toBeString();
    $_SESSION['globalToken'] = $res['token'];
});

test('Create new user', function () {
    $res = post('http://localhost:8080/user', [
        "name"=>"Test user",
        "email"=>"new_user@test.com",
        "password"=>"test_password"
    ], $_SESSION['globalToken']);
    $user = json_decode($res, true);
    expect($user['status'])->toBe(200);
    expect(end($user['data'])['email'])->toBe('new_user@test.com');
    $_SESSION['globalId'] = end($user['data'])['id'];
});

test('Get all users', function () {
    $res = get('http://localhost:8080/user', $_SESSION['globalToken']);
    $users = json_decode($res, true);
    expect($users['status'])->toBe(200); 
});

test('Update user', function () {
    $res = put("http://localhost:8080/user/{$_SESSION['globalId']}", [
        "name"=>"Test user updated",
        "email"=>"user.updated@test.com",
        "password"=>"test_password_updated"
    ], $_SESSION['globalToken']);
    $user = json_decode($res, true);
    expect($user['status'])->toBe(200); 
});

test('Find user by id', function () {
    $res = get("http://localhost:8080/user/{$_SESSION['globalId']}", $_SESSION['globalToken']);
    $user = json_decode($res, true);
    expect($user['status'])->toBe(200); 
});

test('Delete user', function () {
    $res = delete("http://localhost:8080/user/{$_SESSION['globalId']}", $_SESSION['globalToken']);
    $user = json_decode($res, true);
    expect($user['status'])->toBe(200); 
});

test('Delete test user', function () {
    $res = delete("http://localhost:8080/user/{$_SESSION['globalRegisteredId']}", $_SESSION['globalToken']);
    $user = json_decode($res, true);
    unset($_SESSION['globalId']);
    unset($_SESSION['globalToken']);
    unset($_SESSION['globalRegisteredId']);
    session_destroy();
    expect($user['status'])->toBe(200); 
});