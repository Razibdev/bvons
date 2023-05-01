@extends('layouts.simple')

@section('css_after')
    <style>
        section.common h1 {
            font-size: 25px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        section.common h2 {
            font-size: 20px;
            margin-top: 10px;
            margin-bottom: 0;
        }

        section.common {
            box-sizing: border-box;
            background: #fff;
            padding: 25px 25px;
            margin: 10px 0;
            box-shadow: 1px 2px 4px #f1f1f1;
        }
        section.common p {
            margin: 0;
        }
        .social-media h1 {
            margin: 0;
            margin-bottom: 15px;
        }

        .social-media {
            background: #fff;
            margin-top: 53px;
            margin-bottom: 0;
            justify-content: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 25px 0 10px;
            border-top: 3px solid #222;
        }

        .social-media ul li {
            padding: 15px 60px;
            border: 1px solid #3f9ce8;
            border-radius: 2px;
            cursor: pointer;
            transition: all 1s;
        }

        .social-media ul {
            padding: 0;
        }

        .social-media ul li:hover {
            background: coral;
            border: 0;

        }
        .social-media ul li:hover i {
            color: #fff;
        }

    </style>
@endsection


@section('content')

    <div class="container">

        <div class="row mb-5 mt-5 overflow-hidden bg-light p-5 d-flex align-items-center">
            <div class="col-md-6">
                <header>
                    <div class="logo">
                        <h1 class="m-0 font-weight-bold text-uppercase">bVon</h1>
                    </div>
                </header>
            </div>
            <div class="col-md-6">
                <div class="contact-info">
                    <div class="website">
                        <strong>Website : </strong> <a href="https://www.bvon.app">www.bvon.app</a>
                    </div>
                    <div class="email">
                        <strong>E-mail: </strong> <a href="">app.bvon@gmail.com</a>
                    </div>

                    <div class="address">
                        <strong>Address: </strong> Level #02, House #13, Road #02, Sector #06, House Building, Uttara Model Town, Dhaka-1230.
                    </div>
                </div>
            </div>
        </div>




        <hr>
        <h1 class="text-dark text-uppercase font-weight-bold text-center">Privacy Policy</h1>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <section class="common">
                    <h1 class="heading-1">Data we collect which you provide to us:</h1>
                    <ul>
                        <li>Registration</li>
                        <li>Profile</li>
                        <li>Posting and Uploading</li>
                        <li>Your regular activities</li>
                        <li>Service Use</li>
                        <li>Cookies and Similar Technologies</li>
                        <li>Device information</li>
                        <li>Your Device and Location</li>
                        <li>Messages</li>
                        <li>Workplace and School Provided Information</li>
                        <li>Sites and Services of Others</li>
                        <li>Information and content you provide</li>
                        <li>Communications and other information you provide when you use our Products</li>
                        <li>Including when you sign up for an account</li>
                        <li>Posts</li>
                        <li>Likes</li>
                        <li>Follows</li>
                        <li>Comments</li>
                        <li>Create or share content</li>
                        <li>Message or communicate with others</li>
                    </ul>
                </section>
            </div>

            <div class="col-md-6">
                <section class="common">
                    <h1 class="heading-1">Other Important Information:</h1>
                    <div class="sub-block">
                        <h2 class="heading-2">Payment:</h2>
                        <p>All types of transactions are stored for security. And transactions type</p>
                        <ul>
                            <li>Premium User to Premium User</li>
                            <li>Premium User to Businessman</li>
                            <li>Customer to Businessman</li>
                            <li>Businessman to Businessman</li>
                            <li>Transaction / Deposit / Loan / Term Deposit</li>
                            <li>Utility bill payment (WASA, Gas, Electricity, etc.)</li>
                            <li>Insurance premium payment</li>
                            <li>Top-up of mobile banking wallet</li>
                            <li>Mobile top-up Purchasing Data or, SMS your phone number</li>
                        </ul>
                        <p>All types of transactions are securely processed etc.</p>
                    </div>

                    <div class="sub-block">
                        <h2 class="heading-2">Intellectual Property Rights and Posts:</h2>
                        <ul>
                            <li>Never copy others content and Graphics</li>
                            <li>You may earn on your intellectual property</li>
                            <li>If claim and it’s found, you may be punished financially or, activity.</li>
                        </ul>
                    </div>
                </section>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <section class="common">
                    <h1 class="heading-1">Using data:</h1>
                    <ul>
                        <li>bVon’ Services betterment</li>
                        <li>Keeping Connected</li>
                        <li>Keeping Informed</li>
                        <li>Career Planning and Development</li>
                        <li>Productivity of Developers</li>
                        <li>Premium Services</li>
                        <li>Communications</li>
                        <li>Advertising and Marketing</li>
                        <li>Info to Ad Providers</li>
                        <li>Developing Services and Research</li>
                        <li>Service Development</li>
                        <li>Other Research</li>
                        <li>Surveys</li>
                        <li>Customer Support</li>
                        <li>Insights That Do Not Identify You</li>
                        <li>Security and Investigations</li>
                        <li>Product research and development</li>
                        <li>Location-related information</li>
                        <li>Ads and other sponsored content</li>
                    </ul>
                </section>
                <section class="common">
                    <h1 class="heading-1">Other uses of your Personal Information:</h1>
                    <p>We may use your personal information for opinion and market research. Your details will only be used for statistical purposes. We save the answers to our surveys separately from your email address.</p>
                </section>
            </div>
            <div class="col-md-6">
                <section class="common">
                    <h1 class="heading-1">bVon “Dos and Don’ts”:</h1>
                    <div class="sub-block">
                        <h2 class="heading-2">Dos:</h2>
                        <p>bVon is based on professionals and non-professionals community. This list of “Dos and Don’ts” along with our Professional Community Policies limit what you can and cannot do on our Services.</p>
                        <h2 class="heading-3">You agree that you will:</h2>
                        <ul>
                            <li>Follow all the rules and regulations mentioned</li>
                            <li>Provide true information to us and keep it updated</li>
                            <li>Use your certificate name and information on your profile</li>
                            <li>Use all the Services in a professional manner (If not professional). Don’ts</li>
                        </ul>
                        <h2 class="heading-3">You agree that you will not:</h2>
                        <ul>
                            <li>Create a false identity on bVon, or attempt to use another’s account</li>
                            <li>Use any robotic tools to make my Profile or Page or Group overnight</li>
                            <li>Disclose any confidential information of others (even not your employer)</li>
                            <li>Violate the intellectual property rights of others</li>
                            <li>Post anything that contains software viruses, worms, or any other harmful code</li>
                            <li>Share any gambling website link or source</li>
                        </ul>
                    </div>
                </section>
            </div>
        </div>


        <hr>
        <h1 class="text-dark text-uppercase font-weight-bold text-center">Terms and Conditions</h1>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <section class="common">
                    <h1 class="heading-1">In this Terms and Conditions of Use:</h1>
                    <div class="sub-block">
                        <h2 class="heading-2"></h2>
                        <ol>
                            <li>What’s covered in these terms
                                <ul>
                                    <li>It’s important to establish what you can expect from us as you use bVonServices and what we expect from you.</li>
                                    <li>What we expect from you, which establishes certain terms and conditions for using our services</li>
                                </ul>
                            </li>
                            <li>
                                Your ultimate service point bVon
                                <ul style="list-style: none">
                                    <li>
                                        <div class="contact-info">
                                            <div class="website">
                                                <strong>Website : </strong> <a href="https://www.bvon.app">www.bvon.app</a>
                                            </div>
                                            <div class="email">
                                                <strong>E-mail: </strong> <a href="">app.bvon@gmail.com</a>
                                            </div>

                                            <div class="address">
                                                <strong>Address: </strong> Level #02, House #13, Road #02, Sector #06, House Building, Uttara Model Town, Dhaka-1230.
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>Educational Qualification and Age requirements
                                <ul>
                                    <li>You have to complete SSC (Secondary School Certificate) for the best use of bVon</li>
                                    <li>If the authority of bVon wants to verify someone or giving special services in spite of the ineligibility of the user’s guidelines, it’s a special case. And they have deserved the rights.</li>
                                    <li>Below 15 years of age, a boy or girl even kid may use the E-Learning section from the parent’s verified profile.</li>
                                </ul>
                            </li>
                            <li>Your relationship with bVon
                                <ul style="list-style: none">
                                    <li>
                                        <div>When we speak of “bVon,” “we,” “us,” and “our,” we mean bVon and its affiliates. We expect the best feedback from you thus we provide the using tools or services for you.</div>
                                    </li>
                                </ul>
                            </li>
                            <li>In case of problems or disagreements
                                <ul>
                                    <li><strong>Warranty or Guarantee: </strong>All the warranty or guarantee based services must be followed which mentioned the products and services label or its cover.</li>
                                    <li><strong>After-Sale Services: </strong>Clients will get which mentioned sales time or period.</li>
                                    <li><strong>Disclaimers: </strong>The only commitments we make about our services are (1) described in the Warranty or Guarantee section, (2) stated in the service-specific additional terms. We don’t make any other commitments for our services.</li>
                                </ul>
                            </li>
                            <li>Government Law and Maintenance:
                                <ul>
                                    <li>The contents set out herein form an electronic record in terms of (Information & Communication Technology Act, 2006) and rule there under as applicable and as amended from time to time. As such, this document does not require any physical or digital signatures and forms a valid and binding agreement between the Website and the User.</li>
                                    <li>The Website is operated by bVon Limited, a company incorporated under the laws of Bangladesh having its registered office at, Dhaka, Bangladesh. All references to the Website in these Terms shall deem to refer to the aforesaid entity in the inclusion of the online portal.</li>
                                    <li>This Website may also contain links to other websites, which are not operated by bVon, and bVonIn has no control over the linked sites and accepts no responsibility for them or for any loss or damage that may arise from your use of them. Your use of the linked sites will be subject to the terms of use and service contained within each such site.</li>
                                </ul>
                            </li>
                            <li>We reserve the right to change these Terms at any time. Such changes will be effective when posted on the Website. By continuing to use the Website after we post any such changes, you accept the Terms as modified.</li>
                            <li>The Use of the Website is available only to such persons who can legally contract with us.</li>
                            <li>We don’t accept:
                                <ul>
                                    <li>The illegal items which not allowed in Bangladesh.</li>
                                    <li>Wrong phone number and mail address.</li>
                                    <li>Unethical proposal</li>
                                    <li>Irrelevant picture or graphics or content</li>
                                    <li>The irrelevant caption which doesn’t go graphics or photos</li>
                                    <li>Unclear or blur picture</li>
                                    <li>Copy content</li>
                                    <li>50% above content on graphics</li>
                                    <li>Irrelevant website or link which doesn’t go post</li>
                                    <li>Buying and selling in the same advertisement offer these two types.</li>
                                    <li>Multiple items in the same ad</li>
                                    <li>“Job at home” national job advertisement</li>
                                    <li>Counterfeit, counterfeit or replica of any other company’s product</li>
                                    <li>In addition, once the ad is posted, the advertised product/service cannot be changed.</li>
                                    <li>Same advertisement in different pages or groups. The second post must be punished.</li>
                                </ul>
                            </li>
                        </ol>
                    </div>
                </section>
            </div>
        </div>



        <hr>
        <h1 class="text-dark text-uppercase font-weight-bold text-center">FAQ</h1>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <section class="common">
                    <h1 class="heading-1">Frequently Ask Question:</h1>
                    <div class="sub-block">
                        <h2 class="heading-2"></h2>
                        <ol>
                            <li>What is bVon?
                                <ul>
                                    <li>bVon is a platform that provides learning skills, sharing techniques, caring services, one platform all solutions! It also gives you all the social networking features in one place.</li>

                                </ul>
                            </li>
                            <li>How can I create my profile?
                                <ul>
                                    <li>The profile creating process is really easy. Download the app, enter the full name, mobile number, and password - retype the password, submit the OTP code. Welcome to our community.</li>
                                </ul>
                            </li>
                            <li>How to become a verified or Premium User?
                                <ul>
                                    <li> After sign up, click the “Get Verification” option and submit all the true (SSC) information, and checkmarks there. Please, ensure the bKash/Rocket/Nagad transaction ID. You have to pay 500Tk for becoming Premium User (If you are outside of the office, payable 610Tk – Registration Fee 500Tk, bKash/Rocket/Nagad transaction charge 10TK and Currier Charge 100Tk for any District). You will be verified within 24 to 72 hours and got a verified badge.</li>
                                </ul>
                            </li>
                            <li>Is this app charge money?
                                <ul>
                                    <li>The app 100% free for Premium Users. There are two types of users a) General Users and b) Premium Users.</li>
                                </ul>
                            </li>

                            <li>Can I customize my profile and page?
                                <ul>
                                    <li>Yes, you can customize your profile by adding personal details and you can customize the news feed based on your likes and interests.</li>
                                </ul>
                            </li>

                            <li>How do I search for the other Friends?
                                <ul>
                                    <li>Enter phone contacts, bVon ID number, mobile number, name, or e-mail ID.</li>
                                    <li>Search for "People", "Page", or all</li>
                                    <li>You can search for anybody from that list</li>
                                </ul>
                            </li>
                            <li>How can I manage or delete information about me?
                                <ul>
                                    <li>You can access or delete your personal data. You have many choices about how your data is collected, used, and shared. Regulated Members may need to store communications outside of our Service. We use data for security, fraud prevention, and investigations in any case. We use data to help you and fix problems. We develop our Services and conduct research. We promote our Services to you and others. At any time and any cost, you can withdraw the consent you have provided by going to settings. We keep some of your data even after you close your account. We keep most of your personal data for as long as your account is open.</li>
                                </ul>
                            </li>
                        </ol>
                    </div>
                </section>
            </div>
            <div class="col-md-12">
                <section class="common">
                    <h1 class="heading-1">Aims of bVon:</h1>
                    <ul>
                        <li>To drive the emerging youth towards all kinds of positive opportunities through performance in the light of social values.</li>
                        <li>To Increase your income or business by cooperating with each other. To know the unknown and to transform into the known.</li>
                        <li>To arrange various training workshops or provide services for the development of personal and professional skills of the loyal members (Premium Users).</li>
                    </ul>
                </section>
            </div>
        </div>


        <div class="app-feature">
            <hr>
            <h1 class="text-dark text-uppercase font-weight-bold text-center">App Features</h1>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <section class="common">
                        <h1 class="heading-1">Features of bVon app provide:</h1>
                        <div class="sub-block">
                            <h2 class="heading-2"></h2>
                            <ul>
                                <li>Social Media (Sharing your moments, photos, videos, ideas, getting friends’ update and meeting new friends, Watch live videos on the go, Follow your favorite artists, websites, and companies to get their latest news, chatting, Connecting with good soul’s friends, sharing all updates and getting the real information. BUSINESS NETWORKING etc.)</li>
                                <li>E-commerce (Cheapest price, highest quality. Any Premium User can build an own Brand by selling goods locally and internationally, even you can buy from this Marketplace.)</li>
                                <li>E-Learning School (Professional and Academic 100% free for Premium Users)</li>
                                <li>Ride Sharing (Help you for moving faster by Bike, Private Car, etc.)</li>
                                <li>B-Food (Order now your favorite delicious food from anywhere)</li>
                                <li>E-Wallet (Statement view, Transaction / Deposit / Loan / Term Deposit, Utility bill payment, Insurance premium payment, Top-up of mobile banking wallet, Mobile top-up Purchasing Data or, SMS your phone number. For any type of Transaction and purchase – B2B, B2C, PU2PU, C2C). All types of transactions are securely processed etc.</li>
                                <li>B-Courier (PU2PU for Internal goods sending and receiving)</li>
                                <li>B-Courier (B2C for own and others company for E-commerce)</li>
                                <li>Best Card Services (For searching near the location or, getting discount and best services from the chain brands & shops, super shops, FIXED PRICE ANY BRANDED PRODUCTS/SHOWROOMS, SHOES, HOTEL/ PARK/ RESORT, TAILORS & FABRICS, RESTAURANTS, TRANSPORTATIONS, PARLOR, ELECTRONICS - KITCHEN & HOME APPLIANCES, MEDICAL & DIAGNOSTIC SERVICES, FURNITURES, etc.)</li>
                                <li>Blood Bank (Search by location and group)</li>
                                <li>Live Tutor / Tuition (Academic)</li>
                                <li>All types of Alert (Admission, Exam, Results, Job Circulars, and Interviews, Natural Disaster, etc.)</li>
                                <li>Charity (Man for man, Find local social events, and make plans to meet up with friends)</li>
                                <li>E-Doctor (Free for Premium Users) and Live Doctor Visit Services</li>
                                <li>Quizzes / Puzzle / Games (With robot or, friends)</li>
                                <li>Freelancing Marketplace (Graphics & Design, Writing & Translation, Video & Animation, Music & Audio, Programming & Tech, Business, Lifestyle, Sitemap, Web - Mobile & Software Dev, IT & Networking, Data Science & Analytics, Engineering & Architecture, Legal, Admin Support, Customer Service, Sales & Digital Marketing, Accounting & Consulting.)</li>
                                <li>Job Circular Or, CAREER FINDER (Government, Private, Freelancing or Contractual, etc.)</li>
                                <li>News Portal</li>
                                <li>Sell Baazar (For used goods)</li>
                                <li>Technical Person hiring for a short time or, long time learning (Academic and Professional)</li>
                                <li>Reading books, reviews on book/ movies/ business, etc.</li>
                                <li>Earnings from creating Premium Users, Content-Based, and many more.</li>
                            </ul>
                        </div>
                        <div class="alert alert-info text-center text-small">
                            Contact our customer service at app.bvon@gmail.com if you have any queries.
                            Please see the bVon PRIVACY POLICY and USER AGREEMENT
                        </div>
                    </section>
                </div>
            </div>
        </div>

    </div> <!--contianter end -->



    {{--    <div class="social-media">
            <h1 class="text-dark text-uppercase font-weight-bold text-center">Follows</h1>
            <ul style="list-style: none" class="d-flex">
                <li class="mr-5"><a href="http://www.Instagram.com/BestFriendsInc"><i class="fa fa-instagram"></i></a></li>
                <li class="mr-5"><a href="http://www.youtube.com/BestFriendsInc"><i class="fa fa-youtube"></i></a></li>
                <li class="mr-5"><a href="https://www.bvon.app"><i class="fa fa-globe"></i></a></li>
            </ul>
        </div>--}}

@endsection
