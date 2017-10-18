@extends('main')

@section('title', '| Contact')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <h1>Contact Me</h1>
                 <hr>
                 <form action="{{ url('contact') }}" method="POST">
                    {{ csrf_field() }}
                     <dir class="form-group">
                         <label name="email">Email:</label>
                         <input id="email" name="email" class="form-control">
                     </dir>

                     <dir class="form-group">
                         <label name="subject">Subject:</label>
                         <input id="subject" name="subject" class="form-control">
                     </dir>

                     <dir class="form-group">
                         <label name="message">Message:</label> 
                         <textarea id="message" name="message" class="form-control" placeholder="Type your message here..."></textarea><br>

                         <input type="submit" value="Send Message" class="btn btn-success">
                     </dir>
                 </form>
            </div>
        </div>
@endsection
    