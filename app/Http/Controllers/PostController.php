<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    // 1. Menampilkan semua artikel di halaman utama
    public function index()
    {
        // Mengambil artikel terbaru dan membaginya menjadi 3 artikel per halaman
        $posts = Post::latest()->paginate(3);
        return view('blog.index', compact('posts'));
    }

    // 2. Menampilkan form tulis artikel baru
    public function create()
    {
        return view('blog.create');
    }

    // 3. Memproses penyimpanan artikel baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'image' => $imageName
        ]);

        return redirect()->route('blog.index')->with('success', 'Artikel berhasil diterbitkan!');
    }

    // 4. Menampilkan detail satu artikel utuh
    // 4. Menampilkan detail satu artikel utuh beserta menambah jumlah pembaca
    public function show($slug)
    {
        // 1. Cari artikel berdasarkan slug
        $post = Post::where('slug', $slug)->firstOrFail();

        // 2. Tambah jumlah pembaca +1 (Diproses SEBELUM return)
        $post->increment('views');

        // 3. Tampilkan halaman detail artikel
        return view('blog.show', compact('post'));
    }
    // 5. Menampilkan halaman form edit artikel
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('blog.edit', compact('post'));
    }

    // 6. Memproses perubahan data artikel ke database
    public function update(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $request->validate([
            'title' => 'required|min:5',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $imageName = $post->image;
        if ($request->hasFile('image')) {
            // Hapus foto lama jika ada
            if ($post->image && file_exists(public_path('images/' . $post->image))) {
                unlink(public_path('images/' . $post->image));
            }
            // Upload foto baru
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        $post->update([
            'title' => $request->title,
            'slug' => \Illuminate\Support\Str::slug($request->title),
            'content' => $request->content,
            'image' => $imageName
        ]);

        return redirect()->route('blog.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    // 7. Menghapus artikel dari database
    public function destroy($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        // Hapus file gambar dari folder public jika ada
        if ($post->image && file_exists(public_path('images/' . $post->image))) {
            unlink(public_path('images/' . $post->image));
        }

        $post->delete();

        return redirect()->route('blog.index')->with('success', 'Artikel berhasil dihapus!');
    }
}
