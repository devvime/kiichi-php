<?php

test('Get all users', function () {
    $res = get('http://localhost:8080/user');
    $users =  json_decode($res, true);
    expect($users['status'])->toBe(200); 
});

test('Find user by id', function () {
    $res = get('http://localhost:8080/user/56');
    $user =  json_decode($res, true);
    expect($user['status'])->toBe(200); 
});

test('Create new user', function () {
    $res = post('http://localhost:8080/user', [
        "name"=>"Test user",
        "email"=>"user@test.com",
        "password"=>"test_password"
    ]);
    $user =  json_decode($res, true);
    session_start();
    $_SESSION['globalId'] = $user['data']['id'];
    expect($user['status'])->toBe(200);
});

test('Update user', function () {
    $res = put("http://localhost:8080/user/{$_SESSION['globalId']}", [
        "name"=>"Test user updated",
        "email"=>"user.updated@test.com",
        "password"=>"test_password_updated"
    ]);
    $user =  json_decode($res, true);
    expect($user['status'])->toBe(200); 
});

test('Delete user', function () {
    $res = delete("http://localhost:8080/user/{$_SESSION['globalId']}");
    $user =  json_decode($res, true);
    unset($_SESSION['globalId']);
    session_destroy();
    expect($user['status'])->toBe(200); 
});