<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Category;
use Mail;
use Session;

class PagesController extends Controller {

	public function getIndex() {
		# process variable data or params
		# talk to the model
		# receive from the modal
		# compile or process data again if needed
		# pas that data to the correct viewpa

		// Post::all() - means Select * from 'post'
		$posts = Post::orderBy('created_at', 'desc')->limit(4)->get();

        $categories = Category::orderBy('created_at', 'asc')->limit(5)->get();

		return view('pages.welcome')->withPosts($posts)->withCategories($categories);
	}

	public function getAbout() {
		$first = 'Vasile';
		$last = 'Grad';

		$fullname = $first . " " . $last;
		$email = 'vasile@gmail.com';
		$data = [];
		$data['email'] = $email;
		$data['fullname'] = $fullname;

		# return view('pages.about')->with("fullname", $fullname);
		
		# pass one variable - this is the sintax used
		# return view('pages.about')->withFullname($fullname);

		# pass multiple variable
		# return view('pages.about')->withFullname($fullname)->withEmail($email);

		# pass an array called data
		return view('pages.about')->withData($data); 
	}

	public function getContact() {
		return view('pages.contact');
	}

	public function postContact(Request $request) {
		$this->validate($request, [
			'email' => 'required|email',
			'subject' => 'min:3',
			'message' => 'min:10']);

		$data = array(
			'email' => $request->email,
			'subject' => $request->subject,
			'bodyMessage' => $request->message

			);

		Mail::send('emails.contact', $data, function($message) use ($data){
			$message->from($data['email']);
			$message->to('e746d0be70-8c8702@inbox.mailtrap.io');
			$message->subject($data['subject']);
		});

		Session::flash('success', 'You Email was Successfully Sent!');

		return redirect('/');
	}


}