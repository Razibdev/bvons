@extends('layouts.front_layout.front_layout')

@push('css')
    <style>
        .input2{
            padding: 10px;
            display: inherit;
            margin-top: -23px;
            margin-left: 15px;
        }
        .terms-condition{
            margin-bottom: 20px;
        }
        .ptag-now{
            margin-left: 10px;
            font-size: 17px;
            padding: 2px;
        }

        .buttokn{
            margin-top: 7px;
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


        .file-drop-area {
            position: relative;
            display: flex;
            align-items: center;
            max-width: 100%;
            padding: 25px;
            border: 1px dashed rgba(255, 255, 255, 0.4);
            border-radius: 3px;
            transition: .2s
        }

        .choose-file-button {
            flex-shrink: 0;
            background-color: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 3px;
            padding: 8px 15px;
            margin-right: 10px;
            font-size: 12px;
            text-transform: uppercase
        }

        .file-message {
            font-size: small;
            font-weight: 300;
            line-height: 1.4;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis
        }

        .file-input {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            widows: 100%;
            cursor: pointer;
            opacity: 0
        }

    </style>
@endpush
@section('content')
    <main class="main-wrapper">
        <div class="product_area_common mt-50 overflow-hidden">
            <div class="container" >
                <div class="col-md-12" style="margin-bottom: 20px;">
                    <p style="font-size: 24px;">You must agree to our <a href="#">Terms and Conditions</a>  to apply for Dealer </p><input class="input2" type="checkbox" name=""id="termsconditions">
                </div>

                <div class="col-md-12">
                    <div class="row">
                        <div class="terms-condition" style="display: none;">
                            <h3 style="padding: 10px; font-size: 24px;">Terms and Conditions</h3>
                            <p style="padding: 10px; font-size: 18px;">Terms and Conditions fo Application: (All that is required for application)</p>
                            <p class="ptag-now"><i class="fas fa-check-square"></i> A passport size photo.</p>
                            <p class="ptag-now"><i class="fas fa-check-square"></i> Full Address, District, Upazila,Village</p>
                            <p class="ptag-now"><i class="fas fa-check-square"></i> San copy or photo fo national identity card</p>
                            <p class="ptag-now"><i class="fas fa-check-square"></i> Scan copy or photo fo latest educational qualification certificate</p>
                            <p class="ptag-now"><i class="fas fa-check-square"></i> (optional) Write 5 lines about any or your business experiences. IF not, write your business idea in 5 lines.</p>
                            <p class="ptag-now"><i class="fas fa-check-square"></i> Please, Take a meeting schedule on Goole Meet, Zoom, Or WhatsApp by sending 555 BDT to mobile banking or bank account. If you agree on all the issues at the end of meeting,  pay the price of only 5000/= (Five thousand) BDT from the nearest courier withIn 3-7days.</p>
                            <div class="buttokn" style="margin-left: 10px;">
                                <button class="btn btn12" style="background: #DD2B26">Bangla</button> &nbsp; &nbsp;
                                <button class="btn btn12" style="background: #DD2B26" id="disagree">Disagree</button>&nbsp; &nbsp;
                                <button class="btn btn12" style="background: #DD2B26"  id="accept">Agree</button>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-12 application" style="display: none" >
                    <h3>Dealers Application</h3>
                    <div class="row" style="margin-top: 20px;">

                        <div class="col-md-3">
                            <div class="shadow p-3 mb-5 bg-white rounded" >
                                <div class="form-group">
                                    <select name="zone" id="" class="form-control input1">
                                        <option value="0">Select Zone</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="shadow p-3 mb-5 bg-white rounded" >
                                <div class="form-group">
                                    <select name="district" id="" class="form-control input1">
                                        <option value="0">Select District</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="shadow p-3 mb-5 bg-white rounded" >
                                <div class="form-group">
                                    <select name="thana" id="" class="form-control input1">
                                        <option value="0">Select Thana</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="shadow p-3 mb-5 bg-white rounded" >
                                <div class="form-group">
                                    <select name="village" id="" class="form-control input1">
                                        <option value="0">Select Village</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="file-drop-area" style="margin-top: 5px;background: wheat;"> <span class="choose-file-button">Your Image</span> <span class="file-message">or drag and drop files here</span> <input type="file" class="file-input" accept=".jfif,.jpg,.jpeg,.png,.gif" multiple> </div>
                            <div id="divImageMediaPreview"> </div>
                        </div>


                        <div class="col-md-3">
                            <div class="file-drop-area" style="margin-top: 5px;background: wheat;"> <span class="choose-file-button">Last Educational Certificate Image</span> <span class="file-message">or drag and drop files here</span> <input type="file" class="file-input" accept=".jfif,.jpg,.jpeg,.png,.gif" multiple> </div>
                            <div id="divImageMediaPreview"> </div>
                        </div>


                        <div class="col-md-3">
                            <div class="file-drop-area" style="margin-top: 5px;background: wheat;"> <span class="choose-file-button">NID Front Image Image</span> <span class="file-message">or drag and drop files here</span> <input type="file" class="file-input" accept=".jfif,.jpg,.jpeg,.png,.gif" multiple> </div>
                            <div id="divImageMediaPreview"> </div>
                        </div>


                        <div class="col-md-3">
                            <div class="file-drop-area" style="margin-top: 5px;background: wheat;"> <span class="choose-file-button">NID Back Image Image</span> <span class="file-message">or drag and drop files here</span> <input type="file" class="file-input" accept=".jfif,.jpg,.jpeg,.png,.gif" multiple> </div>
                            <div id="divImageMediaPreview"> </div>

                        </div>

                        <div class="col-md-6" style="margin-top: 10px;">
                            <div class="shadow p-3 mb-5 bg-white rounded" >
                                <div class="form-group">
                                    <input type="text" name="" id="" class="form-control input1" placeholder="Business Type (Optional)">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6" style="margin-top: 10px;">
                            <div class="shadow p-3 mb-5 bg-white rounded" >
                                <div class="form-group">
                                    <textarea  name="" id="" class="form-control input1" placeholder="5 Lines about your business idea/experience"></textarea>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6" style="margin-top: 10px;">
                            <div class="shadow p-3 mb-5 bg-white rounded" >
                                <div class="form-group">
                                    <input type="text" name="" id="" class="form-control input1" placeholder="Contact Number 017xxxxxxxxx">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push("js")
    <script>
        $(document).on('change', '.file-input', function() {


            var filesCount = $(this)[0].files.length;

            var textbox = $(this).prev();

            if (filesCount === 1) {
                var fileName = $(this).val().split('\\').pop();
                textbox.text(fileName);
            } else {
                textbox.text(filesCount + ' files selected');
            }



            if (typeof (FileReader) != "undefined") {
                var dvPreview = $("#divImageMediaPreview");
                dvPreview.html("");
                $($(this)[0].files).each(function () {
                    var file = $(this);
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var img = $("<img />");
                        img.attr("style", "width: 150px; height:100px; padding: 10px");
                        img.attr("src", e.target.result);
                        dvPreview.append(img);
                    }
                    reader.readAsDataURL(file[0]);
                });
            } else {
                alert("This browser does not support HTML5 FileReader.");
            }


        });

        $('#termsconditions').on('click',function () {
            $('.terms-condition').css('display','block');
        });

        $('#accept').on('click', function () {
            $('.terms-condition').css('display','none');
            $('.application').css('display','block');

        });

        $('#disagree').on('click', function () {
            $('.terms-condition').css('display','none');
        });

    </script>
@endpush