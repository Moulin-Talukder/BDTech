 <?php $__env->startSection('content'); ?>
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4><?php echo e(trans('file.Add Employee')); ?></h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small style="color:red"><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
                        <?php echo Form::open(['route' => 'employees.store', 'method' => 'post', 'files' => true]); ?>

                        <div class="row">
                            <div class="col-md-12">
                                <h4 style="background:#05e6bd; text-align: center">Employee</h4>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo e(trans('file.Company Name')); ?> *</strong> </label>
                                    <select class="form-control selectpicker" name="company_name" required>
                                        <option value="">Select</option>
                                        <option value="wtl">Wardan Tech Ltd</option>
                                        <option value="wts">Wardan Ship Service Ltd</option>
                                    </select>
                                    <?php if($errors->has('company_name')): ?>
                                    <span>
                                        <strong><?php echo e($errors->first('company_name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label><?php echo e(trans('file.name')); ?> *</strong> </label>
                                    <input type="text" name="employee_name" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <label><?php echo e(trans('Division or Branch')); ?> </strong> </label>
                                    <select class="form-control selectpicker" name="division_branch">
                                        <option value="">Select</option>
                                        <option value="mirpur">Mirpur</option>
                                        <option value="uttara">Uttara</option>
                                    </select>
                                    <?php if($errors->has('division_branch')): ?>
                                    <span>
                                        <strong><?php echo e($errors->first('division_branch')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label><?php echo e(trans('file.Department')); ?> *</label>
                                    <select class="form-control selectpicker" name="department_id" required>
                                        <?php $__currentLoopData = $lims_department_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($department->id); ?>"><?php echo e($department->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label><?php echo e(trans('Employee Code')); ?></label>
                                    <input type="number" name="employee_code" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label><?php echo e(trans('Date of Birth')); ?> *</label>
                                    <input type="date" name="date_of_birth" required class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label><?php echo e(trans('Gender')); ?> *</label>
                                    <select class="form-control selectpicker" name="gender" required>
                                        <option value="">Select</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="transgender">Trangender</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <?php if($errors->has('gender')): ?>
                                    <span>
                                        <strong><?php echo e($errors->first('gender')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><?php echo e(trans('Father Name')); ?> *</label>
                                <input type="text" name="father_name" required class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(trans('Mother Name')); ?> *</label>
                                <input type="text" name="mother_name" required class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(trans('National ID')); ?> *</label>
                                <input type="number" name="national_id" required class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(trans('Marital Status')); ?> *</label>
                                <select class="form-control selectpicker" name="marital_status" required>
                                    <option value="">Select</option>
                                    <option value="married">Married</option>
                                    <option value="unmarried">Unmarried</option>
                                    <option value="widow">Widow</option>
                                </select>
                                <?php if($errors->has('marital_status')): ?>
                                <span>
                                    <strong><?php echo e($errors->first('marital_status')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(trans('Religion')); ?> *</label>
                                <select class="form-control selectpicker" name="religion" required>
                                    <option value="">Select</option>
                                    <option value="islam">Islam</option>
                                    <option value="hindu">Hindu</option>
                                    <option value="buddhist">Buddhist</option>
                                    <option value="christian">Christian</option>
                                </select>
                                <?php if($errors->has('religion')): ?>
                                <span>
                                    <strong><?php echo e($errors->first('religion')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(trans('Blood Group')); ?> *</label>
                                <select class="form-control selectpicker" name="blood_group">
                                    <option value="">Select</option>
                                    <option value="a+">A (+) Positive</option>
                                    <option value="a-">A (-) Negative</option>
                                    <option value="ab+">AB (+) Positive</option>
                                    <option value="ab-">AB (-) Negative</option>
                                    <option value="b+">B (+) Positive</option>
                                    <option value="b-">B (-) Negative</option>
                                    <option value="o+">O (+) Positive</option>
                                    <option value="o-">O (-) Negative</option>
                                </select>
                                <?php if($errors->has('blood_group')): ?>
                                <span>
                                    <strong><?php echo e($errors->first('blood_group')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(trans('Nationality')); ?> *</label>
                                <input type="text" name="nationality" required class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><?php echo e(trans('file.Image')); ?></label>
                                <input type="file" name="image" class="form-control">
                                <?php if($errors->has('image')): ?>
                                <span>
                                    <strong><?php echo e($errors->first('image')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label><?php echo e(trans('Document')); ?></label>
                                <input type="file" name="document" class="form-control">
                                <?php if($errors->has('document')): ?>
                                <span>
                                    <strong><?php echo e($errors->first('document')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group mt-4">
                                <label><?php echo e(trans('file.Add User')); ?></label>
                                <input type="checkbox" name="user" checked value="1" readonly />
                            </div>
                            <div id="user-input" class="mt-4">
                                <div class="form-group">
                                    <label><?php echo e(trans('file.UserName')); ?> *</label>
                                    <input type="text" name="name" required class="form-control">
                                    <?php if($errors->has('name')): ?>
                                    <span>
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label><?php echo e(trans('file.Password')); ?> *</label>
                                    <input required type="password" name="password" class="selectpicker form-control">
                                </div>
                               
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 style="background:#05e6bd; text-align: center">Present Address</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo e(trans('Address Details')); ?> *</label>
                                <textarea rows="4" name="present_address" placeholder="Describe address here..." class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo e(trans('City')); ?> *</label>
                                <select class="form-control selectpicker" name="present_city" required>
                                    <option value="">Select</option>
                                    <option value="Dhaka North">Dhaka North</option>
                                    <option value="Dhaka South">Dhaka South</option>
                                    <option value="Chittagong">Chittagong</option>
                                    <option value="Khulna">Khulna</option>
                                    <option value="Rajshahi">Rajshahi</option>
                                    <option value="Mymensingh">Mymensingh</option>
                                    <option value="Sylhet">Sylhet</option>
                                    <option value="Barisal">Barisal</option>
                                    <option value="Rangpur">Rangpur</option>
                                    <option value="Gazipur">Gazipur </option>
                                    <option value="Narayanganj">Narayanganj</option>
                                </select>
                                <?php if($errors->has('present_city')): ?>
                                <span>
                                    <strong><?php echo e($errors->first('present_city')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(trans('District')); ?> *</label>
                                <select class="form-control selectpicker" name="present_district" required>
                                    <option value="">Select</option>
                                    <option value="Dhaka">Dhaka</option>
                                    <option value="Gazipur">Gazipur</option>
                                    <option value="Chittagong ">Chittagong </option>
                                    <option value="Rangpur ">Rangpur </option>
                                    <option value="Rajshahi ">Rajshahi </option>
                                </select>
                                <?php if($errors->has('present_district')): ?>
                                <span>
                                    <strong><?php echo e($errors->first('present_district')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 style="background:#05e6bd; text-align: center">Permanent Address</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo e(trans('Address Details')); ?> *</label>
                                <textarea rows="4" name="permanent_address" placeholder="Describe address here..." class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo e(trans('City')); ?> *</label>
                                <select class="form-control selectpicker" name="permanent_city" required>
                                    <option value="">Select</option>
                                    <option value="Dhaka North">Dhaka North</option>
                                    <option value="Dhaka South">Dhaka South</option>
                                    <option value="Chittagong">Chittagong</option>
                                    <option value="Khulna">Khulna</option>
                                    <option value="Rajshahi">Rajshahi</option>
                                    <option value="Mymensingh">Mymensingh</option>
                                    <option value="Sylhet">Sylhet</option>
                                    <option value="Barisal">Barisal</option>
                                    <option value="Rangpur">Rangpur</option>
                                    <option value="Gazipur">Gazipur </option>
                                    <option value="Narayanganj">Narayanganj</option>
                                </select>
                                <?php if($errors->has('permanent_city')): ?>
                                <span>
                                    <strong><?php echo e($errors->first('permanent_city')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(trans('District')); ?> *</label>
                                <select class="form-control selectpicker" name="permanent_district" required>
                                    <option value="">Select</option>
                                    <option value="Dhaka">Dhaka</option>
                                    <option value="Gazipur">Gazipur</option>
                                    <option value="Chittagong ">Chittagong </option>
                                    <option value="Rangpur ">Rangpur </option>
                                    <option value="Rajshahi ">Rajshahi </option>
                                </select>
                                <?php if($errors->has('permanent_district')): ?>
                                <span>
                                    <strong><?php echo e($errors->first('permanent_district')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 style="background:#05e6bd; text-align: center">Contact</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo e(trans('file.Email')); ?> *</label>
                                <input type="email" name="email" placeholder="example@example.com" class="form-control" required>
                                <?php if($errors->has('email')): ?>
                                <span>
                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(trans('file.Phone Number')); ?> *</label>
                                <input type="number" name="phone_number" required class="form-control" required>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo e(trans('Office Phone Number')); ?> </label>
                                <input type="number" name="office_phone_number" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h4 style="background:#05e6bd; text-align: center">Emergency Contact</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo e(trans('Name')); ?> </label>
                                <input type="text" name="relative_name" placeholder="example@example.com" class="form-control">
                                <?php if($errors->has('relative_name')): ?>
                                <span>
                                    <strong><?php echo e($errors->first('relative_name')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(trans('Relationship')); ?> *</label>
                                <input type="text" name="relationship" required class="form-control" required>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo e(trans('Phone Number')); ?> </label>
                                <input type="number" name="relative_phone_number" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 style="background:#05e6bd; text-align: center">Job</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo e(trans('Joining Date')); ?> *</label>
                                <input type="date" name="joining_date" placeholder="Joining Date" required class="form-control" required>
                                <?php if($errors->has('joining_date')): ?>
                                <span>
                                    <strong><?php echo e($errors->first('joining_date')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(trans('Position')); ?> *</label>
                                <select class="form-control selectpicker" name="position" required>
                                    <option value="">Select</option>
                                    <option value="sr">Senior</option>
                                    <option value="jr">Junior</option>
                                </select>
                                <?php if($errors->has('position')): ?>
                                <span>
                                    <strong><?php echo e($errors->first('position')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(trans('Grade')); ?> *</label>
                                <select class="form-control selectpicker" name="grade" required>
                                    <option value="">Select</option>
                                    <option value="Staf">Staf</option>
                                    <option value="Officer">Officer</option>
                                    <option value="Executive">Executive</option>
                                    <option value="Manager">Manager</option>
                                </select>
                                <?php if($errors->has('grade')): ?>
                                <span>
                                    <strong><?php echo e($errors->first('grade')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(trans('Qualification')); ?> *</label>
                                <select class="form-control selectpicker" name="qualification" required>
                                    <option value="">Select</option>
                                    <option value="post_raduation">Post Graduation</option>
                                    <option value="graduation">Graduation</option>
                                    <option value="HSC">HSC</option>
                                    <option value="SSC">SSC</option>
                                    <option value="JSC">JSC</option>
                                </select>
                                <?php if($errors->has('qualification')): ?>
                                <span>
                                    <strong><?php echo e($errors->first('qualification')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(trans('Type of Employee')); ?> *</label>
                                <select class="form-control selectpicker" name="type_of_employee" required>
                                    <option value="">Select</option>
                                    <option value="permanent">Permanent</option>
                                    <option value="contractual">Contractual</option>
                                </select>
                                <?php if($errors->has('type_of_employee')): ?>
                                <span>
                                    <strong><?php echo e($errors->first('type_of_employee')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(trans('Overtime Count')); ?> *</label>
                                <select class="form-control selectpicker" name="overtime_count" required>
                                    <option value="">Select</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                <?php if($errors->has('overtime_count')): ?>
                                <span>
                                    <strong><?php echo e($errors->first('overtime_count')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(trans('Effective Date')); ?> *</label>
                                <input type="date" name="effective_date" required class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(trans('Shift')); ?> *</label>
                                <select class="form-control selectpicker" name="shift">
                                    <option value="">Select</option>
                                    <option value="Day">Day</option>
                                    <option value="Night">Night</option>
                                </select>
                                <?php if($errors->has('shift')): ?>
                                <span>
                                    <strong><?php echo e($errors->first('shift')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo e(trans('Present Salary')); ?> </label>
                                <input type="number" name="present_salary" class="form-control">
                            </div>
                            <div class="form-group">
                                <label><?php echo e(trans('Attendance Required')); ?> *</label>
                                <select class="form-control selectpicker" name="attendance_required" required>
                                    <option value="">Select</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                <?php if($errors->has('attendance_required')): ?>
                                <span>
                                    <strong><?php echo e($errors->first('attendance_required')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(trans('Work Starting Time')); ?> *</label>
                                <input type="time" name="work_starting_time" required class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(trans('Work Ending Time')); ?> *</label>
                                <input type="time" name="work_ending_time" required class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(trans('late Count Time')); ?> *</label>
                                <input type="time" name="late_count" required class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(trans('Early Count Time')); ?> *</label>
                                <input type="time" name="early_count" required class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(trans('logout Required')); ?> *</label>
                                <select class="form-control selectpicker" name="logout_required" required>
                                    <option value="">Select</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                <?php if($errors->has('logout_required')): ?>
                                <span>
                                    <strong><?php echo e($errors->first('logout_required')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(trans('Half Day Absent')); ?> *</label>
                                <select class="form-control selectpicker" name="half_day_absent" required>
                                    <option value="">Select</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                <?php if($errors->has('half_day_absent')): ?>
                                <span>
                                    <strong><?php echo e($errors->first('half_day_absent')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h4 style="background:#05e6bd; text-align: center">Employee Weekly Holiday</h4>
                        </div>
                        <div class="col-md-6">
                            <h4 style="background:#05e6bd; text-align: center">Employee Yearly Leave</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo e(trans('Weekly Holiday')); ?> *</label>
                                <select class="form-control selectpicker" name="weekly_holiday" required>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                </select>
                                <?php if($errors->has('weekly_holiday')): ?>
                                <span>
                                    <strong><?php echo e($errors->first('weekly_holiday')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo e(trans('Total Leave')); ?> *</label>
                                <input type="text" name="total_leave" required class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mt-4">
                                <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<script type="text/javascript">
    $("ul#hrm").siblings('a').attr('aria-expanded', 'true');
    $("ul#hrm").addClass("show");
    $("ul#hrm #employee-menu").addClass("active");

    $('#warehouse').hide();
    $('#biller').hide();

    $('input[name="user"]').on('change', function() {
        if ($(this).is(':checked')) {
            $('#user-input').show(400);
            $('input[name="name"]').prop('required', true);
            $('input[name="password"]').prop('required', true);
            $('select[name="role_id"]').prop('required', true);
        } else {
            $('#user-input').hide(400);
            $('input[name="name"]').prop('required', false);
            $('input[name="password"]').prop('required', false);
            $('select[name="role_id"]').prop('required', false);
            
        }
    });

    $('select[name="role_id"]').on('change', function() {
        if ($(this).val() > 2) {
            $('#warehouse').show(400);
            $('#biller').show(400);
            $('select[name="warehouse_id"]').prop('required', true);
            $('select[name="biller_id"]').prop('required', true);
        } else {
            $('#warehouse').hide(400);
            $('#biller').hide(400);
            $('select[name="warehouse_id"]').prop('required', false);
            $('select[name="biller_id"]').prop('required', false);
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bdtech\resources\views/employee/create.blade.php ENDPATH**/ ?>