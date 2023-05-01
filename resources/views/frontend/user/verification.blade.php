@extends('layouts.front_layout.front_layout')

@push('css')
    <style>
        .nav-item.nav-link{
            -webkit-border-radius: 20px;
            -moz-border-radius: 20px;
            border-radius: 20px;
        }
        .nav-item.nav-link.active{
            background: #cae8e4;
        }

        .title1{
            padding: 10px;
            font-size: 21px;
        }
        .details1{
            padding-left: 10px;
            padding-bottom: 5px;
            font-size: 20px;
        }
        .input1{
            border: none;
            height: 35px;
        }

    </style>
@endpush
@section('content')
    <div class="form-validation-user">
        <div class="form-wrapper">
            <form action="">

                <div class="form">
                    <h3>How to Pay</h3>
                    <p>You have to send BDT. 500 as verification charge to the following number +8801788999966</p>

                    <div class="form-group">
                        <label for="">Introducer Information:</label>
                        <input type="text" name="introducer" id="introducer" placeholder="Introducer A/C Number">
                    </div>

                    <h3>SSC Information</h3>

                    <div class="form-group">
                        <input type="text" name="ssc_roll_number" id="ssc_roll_number" placeholder="SSC/Equivalent Roll Number">

                        <input type="text" name="ssc_registration_number" id="ssc_registration_number" placeholder="SSC/Equivalent Registration Number">


                        <div class="group-single">
                            <select name="group" id="group">
                                <option value="Science">Science</option>
                                <option value="Business Studies">Business Studies </option>
                                <option value="Humanities">Humanities</option>
                                <option value="Others">Others</option>
                            </select>

                            <select name="year" id="year">
                                <option value="1971">1971</option>
                                <option value="1972">1972</option>
                                <option value="1973">1973</option>
                                <option value="1974">1974</option>
                                <option value="1975">1975</option>
                                <option value="1976">1976</option>
                                <option value="1977">1977</option>
                                <option value="1978">1978</option>
                                <option value="1979">1979</option>
                                <option value="1980">1980</option>
                                <option value="1981">1981</option>
                                <option value="1982">1982</option>
                                <option value="1983">1983</option>
                                <option value="1984">1984</option>
                                <option value="1985">1985</option>
                                <option value="1986">1986</option>
                                <option value="1987">1987</option>
                                <option value="1988">1988</option>
                                <option value="1989">1989</option>
                                <option value="1990">1990</option>
                                <option value="1991">1991</option>
                                <option value="1992">1992</option>
                                <option value="1993">1993</option>
                                <option value="1994">1994</option>
                                <option value="1995">1995</option>
                                <option value="1996">1996</option>
                                <option value="1997">1997</option>
                                <option value="1998">1998</option>
                                <option value="1999">1999</option>
                                <option value="2000">2000</option>
                                <option value="2001">2001</option>
                                <option value="2002">2002</option>
                                <option value="2003">2003</option>
                                <option value="2004">2004</option>
                                <option value="2005">2005</option>
                                <option value="2006">2006</option>
                                <option value="2007">2007</option>
                                <option value="2008">2008</option>
                                <option value="2009">2009</option>
                                <option value="2010">2010</option>
                                <option value="2011">2011</option>
                                <option value="2012">2012</option>
                                <option value="2013">2013</option>
                                <option value="2014">2014</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                            </select>
                        </div>


                        <select name="board" id="board">
                            <option value="Barisal">Barisal</option>
                            <option value="Chittagong">Chittagong</option>
                            <option value="Comilla">Comilla</option>
                            <option value="Dhaka">Dhaka</option>
                            <option value="Dinajpur">Dinajpur</option>
                            <option value="Jessore">Jessore</option>
                            <option value="Mymensingh">Mymensingh</option>
                            <option value="Madrasha">Madrasha</option>
                            <option value="Rajshahi">Rajshahi</option>
                            <option value="Sylhet">Sylhet</option>
                            <option value="Technical">Technical</option>
                        </select>

                        <input type="email" name="email" id="email" placeholder="E-mail(Must be valid)">


                        <h3>Payment Information</h3>
                        <div class="single-group-payment">
                            <select name="payment" id="payment">
                                <option value="bKash">bKash</option>
                                <option value="Rocket">Rocket</option>
                                <option value="Nagad">Nagad</option>
                                <option value="Direct Payment">Direct Payment</option>
                            </select>

                            <input type="text" name="payment_number" id="payment_number" placeholder="Payment sent by this number">

                            <input type="text" name="transactionid" id="transactionid" placeholder="Transaction Id">
                        </div>

                        <h3>Logistic Information</h3>
                        <div class="single-group-payment">
                            <select name="size" id="size">
                                <option value="Small">Small</option>
                                <option value="Medium">Medium</option>
                                <option value="Large">Large</option>
                                <option value="Extra Large">Extra Large</option>
                                <option value="Maximum">Maximum</option>
                            </select>
                            <input type="text" name="address" id="address" placeholder="Logistics Receiving Address">
                        </div>

                        <button type="submit">Save</button>

                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

@push("js")

@endpush