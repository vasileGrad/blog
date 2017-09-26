<?php

namespace App\Http\Controllers;

class PagesController extends Controller {

	public function getIndex() {
		# process variable data or params
		# talk to the model
		# receive from the modal
		# compile or process data again if needed
		# pas that data to the correct viewpa
		return view('pages.welcome');
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



}