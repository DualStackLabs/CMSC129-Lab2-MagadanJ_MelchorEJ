<?php

use App\Models\Category;
use App\Models\Entry;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

function makeTrashTestEntry(array $attributes = []): Entry
{
    $category = Category::create([
        'name' => 'School',
        'color_theme' => 'emerald',
    ]);

    return Entry::create(array_merge([
        'title' => 'Trash test entry',
        'content' => 'This entry is used to verify trash behavior.',
        'mood' => 'Focused',
        'category_id' => $category->id,
    ], $attributes));
}

test('destroy moves an entry to the trash', function () {
    $entry = makeTrashTestEntry();

    $this->delete(route('entries.destroy', $entry))
        ->assertRedirect(route('entries.index'))
        ->assertSessionHas('success', 'Entry moved to trash.');

    $this->assertSoftDeleted('entries', ['id' => $entry->id]);

    $this->get(route('entries.trash'))
        ->assertOk()
        ->assertSee('Trash test entry');
});

test('force delete permanently removes a trashed entry', function () {
    $entry = makeTrashTestEntry();
    $entry->delete();

    $this->delete(route('entries.forceDelete', $entry->id))
        ->assertRedirect(route('entries.trash'))
        ->assertSessionHas('success', 'Entry permanently deleted.');

    $this->assertDatabaseMissing('entries', ['id' => $entry->id]);
});
