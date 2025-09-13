<x-website-layout>
    <div id="page_caption" class="   " style="padding:0;">

        <div class="page_title_wrapper">
            <div style="background: none" class="standard_wrapper">
                <div class="page_title_inner" style="padding: 50px;">
                    <div class="page_title_content">
                        <h1>Contact Us</h1>
                        <div class="page_tagline">
                            We're here to help reach out anytime! </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="ppb_wrapper  ">

        <div class="one withsmallpadding ppb_contact_box " style="text-align:center;margin-bottom:100px;">
            <div class="standard_wrapper">
                <div class="page_content_wrapper">
                    <div class="inner">
                        <div class="inner_box parallax"
                            style="width:60%;margin:auto;background:#ffffff;border:10px solid #ff2d54;padding:50px;"
                            data-stellar-ratio="1.2">
                            <h2 class="ppb_title" style="color:#000000;">Get In Touch With Us</h2>
                            <div class="page_tagline">We're here to help reach out anytime!</div>
                            <div class="contact_form7_wrapper">
                                <div role="form" class="wpcf7" id="wpcf7-f5-o1" lang="en-US" dir="ltr">
                                    <div class="screen-reader-response"></div>
                                    <form class="quform" action="{{ route('contact.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="quform-elements">
                                            <div class="quform-element">
                                                <input id="name" type="text" name="name" class="input1"
                                                    placeholder="Name*" required>
                                            </div>
                                            <div class="quform-element">
                                                <input id="email" type="email" name="email" class="input1"
                                                    placeholder="Email*" required>
                                            </div>
                                            <div class="quform-element">
                                                <textarea id="message" name="message" class="input1" rows="5"
                                                    placeholder="Message*" required></textarea>
                                            </div>

                                            <div class="quform-submit">
                                                <button type="submit" class="submit-button"><span>Send</span></button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-website-layout>