<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/34590e0ca8.js" crossorigin="anonymous"></script>
    <title><?php echo e($general_setting->site_title); ?></title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        html {
            font-size: 70%;
        }


        /* utility classes */
        .md-heading {
            font-size: 1.6rem;
        }

        .lg-heading {
            font-size: 2.3rem;
        }

        .text-blue {
            color: #152397;
        }

        .sm-heading {
            font-size: 15px;
            margin-bottom: 0.5rem;
        }


        .container {
            max-width: 2000px;
            margin: 0 auto;
            width: 90%;
        }


        .navbar {
            margin-bottom: 20px;
        }


        .navbar .p1,
        .p2 {
            float: left;
            width: 40%;
        }

        .navbar .p3 {
            float: left;
            width: 20%;
        }

        .navbar::after {
            content: "";
            display: block;
            clear: both;
        }


        .semi-r1 .l1 {
            float: left;
            width: 20%;
        }

        .semi-r1 .p1 {
            float: right;
            width: 80%;
        }


        .semi-r1::after {
            content: "";
            display: block;
            clear: both;
        }

        .semi-r2 .l1 {
            float: left;
            width: 40%;
        }

        .semi-r2 .p1 {
            float: right;
            width: 60%;
            border-bottom-style: dotted;

        }


        .semi-r2::after {
            content: "";
            display: block;
            clear: both;
        }

        .semi-r3 .l1 {
            float: left;
            width: 40%;
        }

        .semi-r3 .p1 {
            float: right;
            width: 60%;
            border-bottom-style: dotted;
        }


        .semi-r3::after {
            content: "";
            display: block;
            clear: both;
        }


        .row1 .l1,
        .p1 {
            margin-bottom: 20px;
        }

        .row1 .l1 {
            float: left;
            width: 15%;
        }

        .row1 .p1 {
            border-bottom-style: dotted;
            float: left;
            width: 85%;
        }

        .row1::after {
            content: "";
            display: block;
            clear: both;
        }



        .row2 .l1 {
            float: left;
            width: 15%;
        }

        .row2 .p1 {
            float: right;
            width: 85%;
            border-bottom-style: dotted;
        }

        .row2::after {
            content: "";
            display: block;
            clear: both;
        }


        .row3 .div1,
        .div2,
        .div3 {
            float: left;
            width: 33.333%;
            margin-bottom: 20px;
            padding: 0.2rem;
        }

        .row3::after {
            content: "";
            display: block;
            clear: both;
        }



        .div1 .l1 {
            float: left;
            width: 23%;
        }

        .div1 .p1 {
            float: right;
            width: 74%;
            border-bottom-style: dotted;
        }

        .div1::after {
            content: "";
            display: block;
            clear: both;
        }



        .div2 .l1 {
            float: left;
            width: 20%;
        }

        .div2 .p1 {
            float: right;
            width: 77%;
            border-bottom-style: dotted;
        }

        .div2::after {
            content: "";
            display: block;
            clear: both;
        }

        .div3 .l1 {
            float: left;
            width: 8%;
        }

        .div3 .p1 {
            float: right;
            width: 89%;
            border-bottom-style: dotted;
        }

        .div3::after {
            content: "";
            display: block;
            clear: both;
        }



        .row4 .l1,
        .p1 {
            margin-bottom: 20px;
        }

        .row4 .l1 {
            float: left;
            width: 5%;
        }
        .row4 .l2 {
            float: left;
            width: 4%;
        }

        .row4 .p1 {
            border-bottom-style: dotted;
            float: left;
            width: 90%;
        }

        .row4::after {
            content: "";
            display: block;
            clear: both;
        }



        .row5 .div4,
        .div5 {
            float: left;
            width: 50%;
            margin-bottom: 20px;
            padding: 0.2rem;
        }

        .row5::after {
            content: "";
            display: block;
            clear: both;
        }



        .div4 .l1 {
            float: left;
            width: 14%;
        }

        .div4 .p1 {
            float: right;
            width: 83%;
            border-bottom-style: dotted;
        }

        .div4::after {
            content: "";
            display: block;
            clear: both;
        }



        .div5 .l1 {
            float: left;
            width: 7%;
        }

        .div5 .p1 {
            float: right;
            width: 90%;
            border-bottom-style: dotted;
        }

        .div5::after {
            content: "";
            display: block;
            clear: both;
        }



        .row6 .div6,
        .div7 {
            float: left;
            width: 50%;
            margin-bottom: 20px;
            padding: 0.2rem;
        }

        .row6::after {
            content: "";
            display: block;
            clear: both;
        }


        .div6 .l1 {
            float: left;
            width: 10%;
        }

        .div6 .p1 {
            float: right;
            width: 87%;
            border-bottom-style: dotted;
        }

        .div6::after {
            content: "";
            display: block;
            clear: both;
        }


        .div7 .l1 {
            float: left;
            width: 9%;
        }

        .div7 .p1 {
            float: right;
            width: 88%;
            border-bottom-style: dotted;
        }

        .div7::after {
            content: "";
            display: block;
            clear: both;
        }


        .sub2-row16 {
            margin-top: 0.3rem;
        }

        .sub2-row16 .l25 {
            float: left;
            width: 50%;
        }

        .sub2-row16 .l26 {
            float: right;
            width: 50%;
            text-align: right;
        }


        .sub2-row16::after {
            content: "";
            display: block;
            clear: both;
        }


        .row7 {
            text-align: center;
            /* margin-bottom: 40rem; */
        }

        .section{
            background-image:url(<?php echo e(url('public/logo/b.png')); ?>);
            background-repeat:no-repeat;
            background-position: center;
            background-size: 736px 550px;
        }



        @media (max-width: 1060px) {


            img {
                height: 85px;
                width: 250px;
            }

            .semi-r1 .l1 {
                width: 40%;
            }

            .semi-r1 .p1 {
                width: 60%;
            }

            .semi-r2 .l1,
            .semi-r2 .p1 {
                float: none;
                width: 100%;
            }

            .semi-r3 .l1,
            .semi-r3 .p1 {
                float: none;
                width: 100%;
            }


            .div1 .l1 {
                width: 39%;
            }


            .div1 .p1 {
                width: 57%;
            }


            .div2 .l1 {
                width: 31%;
            }

            .div2 .p1 {
                width: 61%;
            }


            .div3 .l1 {
                width: 14%;
            }

            .div3 .p1 {
                width: 82%;
            }


            .row2 .l1 {
                width: 20%;
            }


            .row2 .p1 {
                width: 80%;
            }


            .row4 .l1 {
                width: 9%;
            }
            .row4 .l1 {
                width: 8%;
            }

            .row4 .p1 {
                width: 82%;
            }


            .div4 .l1 {
                width: 23%;
            }

            .div4 .p1 {
                width: 74%;
            }


            .div5 .l1 {
                width: 11%;
            }

            .div5 .p1 {
                width: 86%;
            }

            .div6 .l1 {
                width: 17%;
            }

            .div6 .p1 {
                width: 80%;
            }


            .div7 .l1 {
                width: 15%;
            }

            .div7 .p1 {
                width: 82%;
            }


            .row1 .l1 {
                width: 25%;
            }

            .row1 .p1 {
                width: 75%;
            }

            .div8 .l1 {
                width: 32%;
            }

            .div8 .p1 {
                width: 68%;
            }

            .div9 .l1 {
                width: 40%;
            }

            .div9 .p1 {
                width: 60%;
            }

        }


        @media  print {

            /* Hide every other element */
            body * {
                visibility: hidden;

            }

            .page-footer {
                position: fixed;
                bottom: 0;
                width: 100%;
            }

            /* Then displaying print container elements */
            •print-container,
            .print-container * {

            }

            .section *{
                visibility: visible;
                background-image:url(<?php echo e(url('public/logo/b.png')); ?>);
                background-repeat:no-repeat;
                background-position-x: 100px;
                background-position-y: 100px;
                background-size: 500px 500px;
            }

            .section::after {
            content: "";
            display: block;
            clear: both;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="sub2-row16">

            <div class="l25">

            </div>

            <div class="l26 md-heading">
                <label for="">print</label>
                <a href="#" class="print" onclick="window.print()" class="btn btn-inverse waves-effect waves-light"><i class="fa fa-print f-16"></i></a>
            </div>


        </div>

    </div>


    <div class="section">
    <div class="container print-container">

        <div class="navbar">

            <div class="image p1">
            <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(url('public/logo/logo.jpeg')); ?>" height="100" width="300" alt="image"></a>
            </div>

            <div class="p2">
                <h2 class="md-heading">
                    <p>SERVICE RECEIPT</p>
                    <p class="sm-heading">(Customer copy)</p>
                </h2>
            </div>

            <div>
                <h2 class="p3 sm-heading">
                    <div class="semi-r1">

                        <div class="l1">
                            <label for="">SL No:</label>
                        </div>

                        <div class="p1">
                            <p><?php echo e($sl_no); ?></p>
                        </div>

                    </div>

                    <div class="semi-r2">
                        <div class="l1">
                            <label for="">Receive Date:</label>
                        </div>

                        <div class="p1">
                            <?php $__currentLoopData = $lims_services_quotation_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$services_quotation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $service_data = DB::table('services')->find($services_quotation->service_id);
                            ?>
                            <p><?php echo e(\Carbon\Carbon::createFromTimestamp(strtotime($service_data->created_at))->format('d-m-Y')); ?></p>
                            <?php break; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                    </div>

                    <div class="semi-r3">

                        <div class="l1">
                            <label for="">Delivary Date:</label>
                        </div>

                        <div class="p1">
                            <p><?php echo e(\Carbon\Carbon::createFromTimestamp(strtotime($lims_quotation_data->delivary_date))->format('d-m-Y')); ?></p>
                        </div>

                    </div>

                </h2>
            </div>

        </div>


        <div class="row1 sm-heading">
            <div class="l1">
                <label for=""><strong>Received with thanks from:</strong></label>
            </div>

            <div class="p1">
                <p><?php echo e($lims_customer_list->company_name); ?></p>
            </div>

        </div>

        <div class="row2 sm-heading">


            <div class="l1">
                <label for=""><strong>Head Office Address:</strong></label>
            </div>

            <div class="p1">
                <p><?php echo e($lims_customer_list->head_office_address); ?></p>
            </div>

        </div>


        <div class="row3 sm-heading">

            <div class="div1">
                <div class="l1">
                    <label for=""><strong>Bareer Name:</strong></label>
                </div>

                <div class="p1">
                    <p><?php echo e($lims_quotation_data->bareer_name); ?></p>
                </div>
            </div>

            <div class="div2">
                <div class="l1">
                    <label for=""><strong>Designation:</strong></label>
                </div>

                <div class="p1">
                    <p><?php echo e($lims_quotation_data->designation); ?></p>
                </div>
            </div>

            <div class="div3">
                <div class="l1">
                    <label for=""><strong>Cell:</strong></label>
                </div>

                <div class="p1">
                    <p><?php echo e($lims_customer_list->phone_number); ?></p>
                </div>
            </div>
        </div>

        <div class="row4 sm-heading">
            <div class="l1">
                <label for=""><strong>Services</strong></label>
            </div>
            <div class="l2">
                <label for=""><b>:</b>  </label>
            </div>

            <div class="p1">
                <?php $__currentLoopData = $lims_services_quotation_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$services_quotation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                $service_data = DB::table('services')->find($services_quotation->service_id);
                ?>

                <?php if($key>0): ?>
                <?php echo e($service_data->name); ?>

                <?php else: ?>
                <p><?php echo e($service_data->name); ?>, </p>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

        </div>


        <div class="row5 sm-heading">

            <div class="div4">
                <div class="l1">
                    <label for=""><strong>Description:</strong></label>
                </div>

                <div class="p1">
                    <p><?php echo e($lims_quotation_data->description); ?></p>
                </div>
            </div>

            <div class="div5">
                <div class="l1">
                    <label for=""><strong>P.S.L:</strong></label>
                </div>

                <div class="p1">
                    <p><?php echo e($lims_quotation_data->p_sl); ?></p>
                </div>
            </div>
        </div>

        <div class="row6 sm-heading">

            <div class="div6">
                <div class="l1">
                    <label for=""><strong>Purpose:</strong></label>
                </div>

                <div class="p1">
                    <p><?php echo e($lims_quotation_data->purpose); ?></p>
                </div>
            </div>

            <div class="div7">
                <div class="l1">
                    <label for=""><strong>BD.S.L:</strong></label>
                </div>

                <div class="p1">
                    <p><?php echo e($lims_quotation_data->bd_sl); ?></p>
                </div>
            </div>
        </div>


        <div class="row7 sm-heading">

            <label for="">N.B: Please take your products within 90 days, otherwise no objection granted for any damage or loss</label>

        </div>

        <div class="page-footer">
        <img src="<?php echo e(url('public/logo/f.png')); ?>" alt="Side Image" style="width:100%;">
    </div>

    </div>
    </div>

    <script type="text/javascript">
        /* function auto_print() {
            window.print()
        }
        setTimeout(auto_print, 1000); */
    </script>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\bdtech_new\resources\views/service_quotation/receipt.blade.php ENDPATH**/ ?>