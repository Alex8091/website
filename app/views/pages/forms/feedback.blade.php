@extends('layouts.master')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            <h2>Participant Feedback</h2>
            @if (!$tookPart)
            <div class="alert basic error">
                <p>According to our records, you didn't participate in ten.java 2014.</p>
            </div>
            @else
                <p>As a participant, we're interested to hear what you liked and disliked about ten.java now that you have completed the contest.
                   Tell us your thoughts on the themes, site, official stream, etc and anything you'd like us to take into account for next time.</p>
                @if ($errors->any())
                    <div class="alert block error">
                        <h4>Submission errors</h4>
                        <ul>
                            @foreach($errors->all('<li>:message</li>') as $message)
                                {{ $message }}
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{ Form::open(array('url' => '/feedback', 'class' => 'form')) }}
                <div class="control-group">
                    <label for="comment">Comments</label>
                    <div class="control">
                        <textarea name="comment" id="comment">{{{ Input::old('comment') }}}</textarea>
                    </div>
                </div>
                <input type="submit" value="Send feedback" class="button button-block button-flat-primary">
                {{ Form::close() }}
            @endif
        </div>
    </div>
</div>
@stop