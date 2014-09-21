<h1>Howdy, {{{ $name }}}!</h1>
<p>
    You're receiving this email because someone (hopefully you!) used this email address to subscribe to updates about
    the upcoming ten.java competition. If this was on purpose, please confirm your subscription by clicking
    <a href="https://tenjava.com/confirm/{{{ $hmac->createSignature($email, Config::get('gh-data.verification-key')) }}}">here</a>.
</p>
<p>
    Thanks for subscribing! When there is significant news about the upcoming ten.java contest, you will receive an
    email detailing the latest news. You can always unsubscribe by going back to the
    <a href="https://tenjava.com/subscribe">subscription page</a>.
</p>
<p>
    We hope you're as excited for the next contest as we are! We'll be sure to keep in touch.
</p>
<p>
    See you around,<br/>
    The ten.java Team
</p>
