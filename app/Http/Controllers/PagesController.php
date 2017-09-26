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
		return view('pages.about');
	}

	public function getContact() {
		return view('pages.contact');
	}



}