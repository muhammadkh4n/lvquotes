<?php

namespace App\Http\Controllers;

use App\Author;
use App\AuthorLog;
use Illuminate\Support\Facades\Event;
use App\Events\QuoteCreated;
use App\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{

    public function getIndex($author = null)
    {
        $author_info = ['author' => $author, 'quotes' => 0];
        $quotes = Quote::orderBy('created_at', 'desc')->paginate(6);

        if (!is_null($author)) {
            $quote_author = Author::where('name', $author)->first();
            if ($quote_author) {
                $quotes = $quote_author->quotes()->orderBy('created_at', 'desc')->paginate(6);
                $author_info['quotes'] = 1;
            }
        }

        return view('index', ['quotes' => $quotes, 'author_info' => $author_info]);
    }

    public function postQuote(Request $req)
    {

        $this->validate($req, [
            'author' => 'required|max:60',
            'quote' => 'required|max:500',
            'email' => 'required|email'
        ]);

        $authorText = ucfirst(strtolower($req['author']));
        $authorEmail = $req['email'];
        $quoteText = $req['quote'];

        $author = Author::where('name', $authorText)->first();
        if (!$author) {
            $author = new Author();
            $author->name = $authorText;
            $author->email = $authorEmail;
            $author->save();
        }

        $quote = new Quote();
        $quote->quote = $quoteText;
        $author->quotes()->save($quote);

        Event::fire(new QuoteCreated($author));

        return redirect()->route('index')->with([
            'success' => 'Quote saved'
        ]);

    }

    public function deleteQuote($id)
    {
        $quote = Quote::find($id);
        $author_deleted = false;

        if (count($quote->author->quotes) === 1) {
            $quote->author->delete();
            $author_deleted = true;
        }

        $quote->delete();

        $msg = $author_deleted ? 'Quote and Author deleted' : 'Quote deleted';
        return redirect()->route('index')->with(['success' => $msg]);
    }

    public function getMailCallback($author_name) {
        $author_log = new AuthorLog();
        $author_log->author = $author_name;
        $author_log->save();

        return view('email.callback', ['author' => $author_name]);
    }
}