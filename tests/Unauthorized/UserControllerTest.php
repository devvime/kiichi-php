<?php

test('Get all users Unauthorized', function () {
    $res = get('http://localhost:8080/user');
    $users =  json_decode($res, true);
    expect($users['error'])->toBe("You are not logged in!");
});

test('Get all users Invalid Token', function () {
    $res = get('http://localhost:8080/user', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6NCwibmFtZSI6IlN0ZXZlIiwiZW1haWwiOiJzdHZAbWFpbC5jb20ifQ.YFO-FLTLXGyPhqzBJZpTyd0qj-nyySL6OOh_CqpaklkYh');
    $users =  json_decode($res, true);
    expect($users['error'])->toBe("Invalid authorization token!");
});

test('Create new user Unauthorized', function () {
    $res = post('http://localhost:8080/user', [
        "name"=>"Test user",
        "email"=>"user@test.com",
        "password"=>"test_password"
    ]);
    $user =  json_decode($res, true);
    expect($user['error'])->toBe("You are not logged in!");
});

test('Create new user Invalid Token', function () {
    $res = post('http://localhost:8080/user', [
        "name"=>"Test user",
        "email"=>"user@test.com",
        "password"=>"test_password"
    ], 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6NCwibmFtZSI6IlN0ZXZlIiwiZW1haWwiOiJzdHZAbWFpbC5jb20ifQ.YFO-FLTLXGyPhqzBJZpTyd0qj-nyySL6OOh_CqpaklkYh');
    $user =  json_decode($res, true);
    expect($user['error'])->toBe("Invalid authorization token!");
});

test('Update user Unauthorized', function () {
    $res = put("http://localhost:8080/user/1", [
        "name"=>"Test user updated",
        "email"=>"user.updated@test.com",
        "password"=>"test_password_updated"
    ]);
    $user =  json_decode($res, true);
    expect($user['error'])->toBe("You are not logged in!");
});

test('Update user Invalid Token', function () {
    $res = put("http://localhost:8080/user/1", [
        "name"=>"Test user updated",
        "email"=>"user.updated@test.com",
        "password"=>"test_password_updated"
    ], 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6NCwibmFtZSI6IlN0ZXZlIiwiZW1haWwiOiJzdHZAbWFpbC5jb20ifQ.YFO-FLTLXGyPhqzBJZpTyd0qj-nyySL6OOh_CqpaklkYh');
    $user =  json_decode($res, true);
    expect($user['error'])->toBe("Invalid authorization token!");
});

test('Find user by id Unauthorized', function () {
    $res = get("http://localhost:8080/user/1");
    $user =  json_decode($res, true);
    expect($user['error'])->toBe("You are not logged in!");
});

test('Find user by id Invalid Token', function () {
    $res = get("http://localhost:8080/user/1", 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6NCwibmFtZSI6IlN0ZXZlIiwiZW1haWwiOiJzdHZAbWFpbC5jb20ifQ.YFO-FLTLXGyPhqzBJZpTyd0qj-nyySL6OOh_CqpaklkYh');
    $user =  json_decode($res, true);
    expect($user['error'])->toBe("Invalid authorization token!");
});

test('Delete user Unauthorized', function () {
    $res = delete("http://localhost:8080/user/1");
    $user =  json_decode($res, true);
    expect($user['error'])->toBe("You are not logged in!"); 
});

test('Delete user Invalid Token', function () {
    $res = delete("http://localhost:8080/user/1", 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6NCwibmFtZSI6IlN0ZXZlIiwiZW1haWwiOiJzdHZAbWFpbC5jb20ifQ.YFO-FLTLXGyPhqzBJZpTyd0qj-nyySL6OOh_CqpaklkYh');
    $user =  json_decode($res, true);
    expect($user['error'])->toBe("Invalid authorization token!"); 
});
