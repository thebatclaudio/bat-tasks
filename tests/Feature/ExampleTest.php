<?php

test("has a welcome page", function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test("expect things", function() {
    $value = "Tech & Beer #2";

    expect($value)
        ->toBe("Tech & Beer #2")
        ->toBeString()
        ->not->toBe("Tech & Wine #2")
        ->toContain("Beer");
});

test("has a contact page")->skip();

test("has beers", function (string $beer) {
    expect($beer)->not->toBeEmpty();
})->with(["Kalopsia", "Glitch", "Sex Pills", "Acqua Santa"]);

test("has drinks", function (array $drinks) {
    expect($drinks)->toBeArray()->each->toBeString();
})->with([
    ["beers" => ["Kalopsia", "Glitch", "Sex Pills", "Acqua Santa"]],
    ["cocktails" => ["Mojito", "Spritz", "Negroni"]],
    ["soft" => ["Water", "Coke"]]
]);

test("can generate email of a user", function(\App\Models\User $user) {
    expect($user->email)
        ->not->toBeEmpty()
        ->toBeString();
})->with([
    fn() => \App\Models\User::factory()->create()
]);

test("has beers (with shared dataset)", function (string $beer) {
    expect($beer)->not->toBeEmpty();
})->with("beers");

beforeEach(function() {
    \App\Models\User::factory()->create();
});

test("has users", function() {
    $this->assertDatabaseHas("users", [
        "id" => 1,
    ]);
});

test("has users 2", function() {
    $this->assertDatabaseHas("users", [
        "id" => 1,
    ]);
});

function asAdmin(): \Tests\TestCase
{
    $user = \App\Models\User::factory()->create([
        "name" => "Batman",
        "is_admin" => true
    ]);

    return test()->actingAs($user);
}

test("admin can create tasks", function() {
    $response = asAdmin()
        ->post("/api/tasks", [
            "title" => "Fight Joker",
            "description" => "Fight Joker in ACE Chemicals",
            "status" => \App\Models\Task::STATUS["PLANNED"]
        ]);
        $response->assertStatus(201);
});

function asSimpleUser(): \Tests\TestCase
{
    $user = \App\Models\User::factory()->create([
        "name" => "Robin",
        "is_admin" => false
    ]);

    return test()->actingAs($user);
}

test("user cannot create tasks", function() {
    $response = asSimpleUser()
        ->post("/api/tasks", [
            "title" => "Fight Joker",
            "description" => "Fight Joker in ACE Chemicals",
            "status" => \App\Models\Task::STATUS["PLANNED"]
        ]);
        $response->assertStatus(403);
});
