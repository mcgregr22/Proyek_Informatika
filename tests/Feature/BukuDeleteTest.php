<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Buku;
use App\Models\Koleksi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class BukuDeleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_delete_own_book()
    {
        // Create user
        $user = User::factory()->create();

        // Create book for the user
        $book = Buku::factory()->create(['user_id' => $user->id]);

        // Create koleksi entry
        Koleksi::create([
            'user_id' => $user->id,
            'id_buku' => $book->id_buku,
            'qty' => 1,
            'access_status' => 'private',
            'koleksi_date' => now(),
        ]);

        // Act as the user
        $this->actingAs($user);

        // Delete the book
        $response = $this->delete(route('buku.destroy', $book->id_buku));

        // Assert redirect to mycollection with success message
        $response->assertRedirect(route('mycollection.index'));
        $this->assertDatabaseMissing('buku', ['id_buku' => $book->id_buku]);
        $this->assertDatabaseMissing('koleksi', ['id_buku' => $book->id_buku]);
    }

    /** @test */
    public function user_cannot_delete_other_users_book()
    {
        // Create two users
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        // Create book for user1
        $book = Buku::factory()->create(['user_id' => $user1->id]);

        // Act as user2
        $this->actingAs($user2);

        // Try to delete user1's book
        $response = $this->delete(route('buku.destroy', $book->id_buku));

        // Assert 404 (not found) because the book is not accessible to user2
        $response->assertStatus(404);
        $this->assertDatabaseHas('buku', ['id_buku' => $book->id_buku]);
    }

    /** @test */
    public function deleting_book_removes_cover_image()
    {
        // Create user
        $user = User::factory()->create();

        // Create fake image file
        Storage::fake('public');
        $image = UploadedFile::fake()->image('cover.jpg');

        // Create book with cover image
        $book = Buku::factory()->create([
            'user_id' => $user->id,
            'cover_image' => $image->store('buku', 'public')
        ]);

        // Act as the user
        $this->actingAs($user);

        // Delete the book
        $this->delete(route('buku.destroy', $book->id_buku));

        // Assert book is deleted
        $this->assertDatabaseMissing('buku', ['id_buku' => $book->id_buku]);

        // Assert image is deleted from storage
        Storage::assertMissing('public/' . $book->cover_image);
    }

    /** @test */
    public function delete_button_appears_on_edit_page()
    {
        // Create user
        $user = User::factory()->create();

        // Create book for the user
        $book = Buku::factory()->create(['user_id' => $user->id]);

        // Act as the user
        $this->actingAs($user);

        // Visit edit page
        $response = $this->get(route('buku.edit', $book->id_buku));

        // Assert the delete button is present
        $response->assertSee('Hapus Buku');
        $response->assertSee(route('buku.destroy', $book->id_buku));
    }
}
