<footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
    
            <h3 class="footer-title">
                @if(setting('site.logo'))
                <img height="40px" src="/storage/{{ setting('site.logo') }}">
                @else
                {{ setting('site.title') }}
                @endif
              </h3>
                
            <p><b>ECRcentral</b> is a central platform for early career researchers to find postdoc research fellowships, travel grants and to share experiences and to provide feedback.
            </p>
            <h3 class="footer-title"> Follow us</h3>
            <ul class="list-unstyled list-inline list-social-icons">
                    
                    <li>
                        <a href="https://twitter.com/ECRcentral" target="_blank"><i class="fa fa-twitter-square fa-2x"></i></a>
                    </li>
                    <li>
                        <a href="https://fb.me/ECRcentral" target="_blank"><i class="fa fa-facebook-square fa-2x"></i></a>
                    </li>
                    <li>
                        <a href="https://github.com/ecrcentral" target="_blank"><i class="fa fa-github-square fa-2x"></i></a>
                    </li>
                </ul>
          </div>

          <div class="col-md-4">
              <br>
            <a class="twitter-timeline" href="https://twitter.com/ECRcentral?ref_src=twsrc%5Etfw">Tweets by ECRcentral</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
          </div>

           <div class="col-md-4">
            <div class="footer-banner">
              <h3 class="footer-title">Links</h3>
              <ul>
              <li {{ Route::is('about') ? 'class=active' : null }}><a href="{{ route('about') }}">About</a></li>
              
              <li {{ Route::is('team') ? 'class=active' : null }}><a href="{{ route('team') }}">Our Team</a></li>
              <li {{ Request::is('funders') ? 'class=active' : null }}><a href="{{ route('funders') }}">Funders</a></li>
              <li {{ Route::is('terms') ? 'class=active' : null }}><a  href="{{ route('terms') }}">Terms of Use</a></li>
              <li {{ Route::is('privacy') ? 'class=active' : null }}><a href="{{ route('privacy') }}">Privacy Policy</a></li>
              <li {{ Route::is('contact') ? 'class=active' : null }}><a href="{{ route('contact') }}">Contact us</a></li>

            </ul>
            </div>
          </div>
         
        </div>
      </div>
    </footer>

  <div id="footerc">
    <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <center>
            <p style="color: #fff;">&copy; 2019 ECRcentral. The content is licensed under <a rel="license" href="http://creativecommons.org/licenses/by/4.0/" target="_blank"> <i class="fa fa-creative-commons" aria-hidden="true"></i> </a> CC BY 4.0 | Developed with <span style="color: #e25555;">&#9829;</span> by eLife Ambassadors.</p>
              </center>
      </div>
    </div>
  </div>
 </div>
