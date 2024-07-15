<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/34590e0ca8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="">
    <title>invoice</title>


    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            /* text-transform: uppercase; */
        }


        html {
            font-size: 100%;
        }


        .sm-font{
            font-size: 80%;
        }


        .header {
            position: relative;
            height: 30vh;
            background-position: center;
        }


        .container {
            max-width: 1200px;
            margin: 0 auto;
            width: 95%;
            background-image:url(<?php echo e(url('public/logo/b.png')); ?>);
            background-repeat:no-repeat;
            background-position: center;
            background-size: 1207px 837px;

        }

        .container::after{
            content: "";
            display: block;
            clear: both;
        }


        .header img {
            float: right;
            margin-top: 5rem;
        }


        .header::after {
            content: "";
            display: block;
            clear: both;
        }


        .md-heading {
            font-size: 1.6rem;
        }

        .sm-heading {
            font-size: 75%;
            margin-bottom: 0.5rem;
        }

        /* .row1 {
            border: 1px solid black;
        } */

        .row1 .div1 {
            float: left;
            width: 40%;
        }

        .row1 .div2 {
            float: left;
            width: 20%;
            border: 1px solid black;
            text-align: center;
        }

        .row1 .div3 {
            float: left;
            width: 40%;
            text-align: right;
        }



        .row1::after {
            content: "";
            display: block;
            clear: both;
        }


        table {
            /* font-family: arial, sans-serif; */
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 5rem;
            min-height: 240px;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }


        th.non_border {
            border: none;
        }


        .name {
            /* float: right; */
            margin-left: 10px;
        }

        .l9 {
            margin-bottom: 2rem;
        }

        .page-footer {
            /* position: fixed;
            bottom: 0; */
            width: 100%;
        }


        @media  print {


            .row1 {
                margin-top: -8rem;
            }

            .page-footer {
                position: fixed;
                bottom: 0;
                width: 100%;
            }

            .container {
                background-image:url(<?php echo e(url('public/logo/b.png')); ?>);
                background-repeat:no-repeat;
                background-position-x: 0px;
                background-position-y: 80px;
                background-size: 750px 850px;
            }

            .container::after{
                opacity: 0.06;
            }
        }
    </style>

</head>

<body>


<div class="container">

    <header class="header">
        <img src="<?php echo e(url('public/logo/logo.png')); ?>" height="100" width="300" alt="logo1">
    </header>

    <div class="row1">

        <div class="div1 sm-heading">

            <div class="l1">
                <label for="">To</label>
                <p><?php echo e($lims_sale_data->customer->company_name); ?></p>
            </div>

            <div class="l2">
                <label for="">Address: <?php echo e($lims_sale_data->customer->head_office_address); ?></label>
            </div>

            <div class="l4">
                <label for="">Email: <?php echo e($lims_sale_data->customer->email); ?></label>
            </div>
            <div class="l5">
                <label for="">Phone: <?php echo e($lims_sale_data->customer->phone_number); ?></label>
            </div>


        </div>

        <div class="div2">

            <div class="l6">
                <label for="">Delivery Chalan</label>
            </div>

        </div>

        <div class="div3 sm-heading">

            <div class="l7">
                <label for="">Date: <?php echo e($date); ?></label>
            </div>
            <div class="l8">
                <label for="">Chalan No: <?php echo e($chalan_no); ?></label>
            </div>

        </div>

    </div>



    <div class="table">
        <table>

            <thead>
            <tr >
                <th style="text-align:center" width="10%">SL NO</th>
                <th style="text-align:center">Description</th>
            </tr>
            </thead>

            <tbody>
            <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    <td style="text-align:center"><?php echo e($key+1); ?></td>
                    <td>
                        <strong><?php echo e($service->name); ?></strong>
                        <?php if($loop->last): ?>
                            <p>
                                <em>
                                    <span>Sr No: </span>
                                    <span>
                                        <?php if(isset($lims_sale_data->service_quotations)): ?>
                                            <?php echo e($lims_sale_data->service_quotations->quotation_no); ?>

                                        <?php endif; ?>

                                    </span>
                                    <span>BD.SL: </span>
                                    <span>
                                        <?php if(isset($lims_sale_data->service_quotations)): ?>
                                            <?php echo e($lims_sale_data->service_quotations->bd_sl); ?>

                                        <?php endif; ?>
                                    </span>
                                    <span>
                                        <span>Warranty: </span>
                                        <?php if(isset($lims_sale_data->service_quotations)): ?>
                                            <?php echo e($lims_sale_data->service_quotations->warranty); ?>

                                        <?php endif; ?>
                                    </span>
                                    
                                </em> 
                            </p>
                        <?php endif; ?>
                        
                    </td>
                </tr>
            </tbody>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tfoot>
            <tr>
            
            </tr>
            </tfoot>

        </table>

    </div>

    <div class="name">
        <div class="l9">
            <label for="">Best Regards</label>
        </div>

        <div class="l10">
            <p>Managing Director</p>
            <p>BDTech Solution</p>
            <p>Mobile: +8801837283923</p>
        </div>
    </div>

    <div class="page-footer" style="margin-bottom:20px;">
        <img src="<?php echo e(url('public/logo/f.png')); ?>" alt="Side Image" style="width:100%;">
    </div>

</div>

<script type="text/javascript">
    function auto_print() {
        window.print()
    }
    setTimeout(auto_print, 1000);
</script>



</body>

</html>
<?php /**PATH /home/wardan/bdtech.wardan.biz/resources/views/sale/service_chalan.blade.php ENDPATH**/ ?>