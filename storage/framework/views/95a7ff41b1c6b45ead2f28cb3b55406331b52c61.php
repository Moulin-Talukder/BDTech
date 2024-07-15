 <?php $__env->startSection('content'); ?>
<?php if($errors->has('name')): ?>
<div class="alert alert-danger alert-dismissible text-center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e($errors->first('name')); ?>

</div>
<?php endif; ?>
<?php if($errors->has('image')): ?>
<div class="alert alert-danger alert-dismissible text-center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e($errors->first('image')); ?>

</div>
<?php endif; ?>
<?php if($errors->has('email')): ?>
<div class="alert alert-danger alert-dismissible text-center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e($errors->first('email')); ?>

</div>
<?php endif; ?>
<?php if(session()->has('message')): ?>
<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo session()->get('message'); ?></div>
<?php endif; ?>
<?php if(session()->has('not_permitted')): ?>
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div>
<?php endif; ?>
<section>
    <?php if(in_array("employees-add", $all_permission)): ?>
    <div class="container-fluid">
        <a href="<?php echo e(route('employees.create')); ?>" class="btn btn-info"><i class="dripicons-plus"></i> <?php echo e(trans('file.Add Employee')); ?></a>
    </div>
    <?php endif; ?>
    <div class="table-responsive">
        <table id="employee-table" class="table">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th><?php echo e(trans('file.Image')); ?></th>
                    <th><?php echo e(trans('file.name')); ?></th>
                    <th><?php echo e(trans('file.Email')); ?></th>
                    <th><?php echo e(trans('file.Phone Number')); ?></th>
                    <th><?php echo e(trans('file.Department')); ?></th>
                    <th><?php echo e(trans('Status')); ?></th>
                    <th class="not-exported"><?php echo e(trans('file.action')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $lims_employee_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $department = \App\Department::find($employee->department_id); ?>
                <tr data-id="<?php echo e($employee->id); ?>">
                    <td><?php echo e($key); ?></td>
                    <?php if($employee->image): ?>
                    <td> <img src="<?php echo e(url('public/images/employee',$employee->image)); ?>" height="80" width="80">
                    </td>
                    <?php else: ?>
                    <td>No Image</td>
                    <?php endif; ?>
                    <td><?php echo e($employee->employee_name); ?></td>
                    <td><?php echo e($employee->email); ?></td>
                    <td><?php echo e($employee->phone_number); ?></td>
                    <td><?php echo e($department->name); ?></td>
                    <td>
                        <a href="<?php echo e(route('employee.inactive',$employee->id)); ?>">
                            <?php if($employee->is_active): ?>
                            <button type="button" class="btn btn-success">Active</button>

                            <?php else: ?>

                            <button type="button" class="btn btn-danger">Inactive</button>

                            <?php endif; ?>
                        </a>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e(trans('file.action')); ?>

                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <?php if(in_array("employees-edit", $all_permission)): ?>
                                <li>
                                    
                                    <a href="<?php echo e(route('employees.edit', $employee->id)); ?>" class="btn btn-link"><i class="dripicons-document-edit"></i> <?php echo e(trans('file.edit')); ?></a>
                                </li>
                                <?php endif; ?>
                                <li class="divider"></li>
                                <?php if(in_array("employees-delete", $all_permission)): ?>
                                <?php echo e(Form::open(['route' => ['employees.destroy', $employee->id], 'method' => 'DELETE'] )); ?>

                                <li>
                                    <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="dripicons-trash"></i> <?php echo e(trans('file.delete')); ?></button>
                                </li>
                                <?php echo e(Form::close()); ?>

                                <?php endif; ?>
                                <li class="divider"></li>
                                <?php if(in_array("employees-edit", $all_permission)): ?>
                                <li>
                                    <a href="<?php echo e(route('employees.show', $employee->id)); ?>" class="btn btn-link"><i class="fa fa-eye"></i> <?php echo e(trans('View')); ?></a>
                                </li>
                                <?php endif; ?>

                            </ul>
                        </div>
                    </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</section>

<div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Update Employee')); ?></h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
                <?php echo Form::open(['route' => ['employees.update', 1], 'method' => 'put', 'files' => true]); ?>

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
                            <input type="text" name="name" required class="form-control">
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
                            <input type="date" name="date_of_birth" id="date_of_birth" required class="form-control" required>
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
                            <select class="form-control selectpicker" name="religion" id="religion" required>
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
                            <select class="form-control selectpicker" name="blood_group" id="blood_group">
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
                            <input type="text" name="nationality" id="nationality" class="form-control" required>
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
                        <label><?php echo e(trans('file.Email')); ?> </label>
                        <input type="email" name="email" placeholder="example@example.com" required class="form-control">
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
                    <div class="form-group">
                        <label><?php echo e(trans('Office Phone Number')); ?> </label>
                        <input type="number" name="office_phone_number" required class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo e(trans('Emergency Contact 1')); ?> *</label>
                        <input type="number" name="emergency_contact1" required class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label><?php echo e(trans('Emergency Contact 2')); ?> </label>
                        <input type="number" name="emergency_contact2" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label><?php echo e(trans('Relationship')); ?> *</label>
                        <input type="text" name="relationship" required class="form-control" required>
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
                        <select class="form-control selectpicker" name="overtime_count" id="overtime_count" required>
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
                        <input type="number" name="present_salary" id="present_salary" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label><?php echo e(trans('Attendance Required')); ?> *</label>
                        <select class="form-control selectpicker" name="attendance_required" id="attendance_required">
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
                        <input type="time" name="work_starting_time" id="work_starting_time" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label><?php echo e(trans('Work Ending Time')); ?> *</label>
                        <input type="time" name="work_ending_time" id="work_ending_time" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label><?php echo e(trans('late Count Time')); ?> *</label>
                        <input type="time" name="late_count" id="late_count" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label><?php echo e(trans('Early Count Time')); ?> *</label>
                        <input type="time" name="early_count" id="early_count" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label><?php echo e(trans('logout Required')); ?> *</label>
                        <select class="form-control selectpicker" name="logout_required" id="logout_required" required>
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
                        <select class="form-control selectpicker" name="half_day_absent" id="half_day_absent" required>
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
                        <select class="form-control selectpicker" name="weekly_holiday" id="weekly_holiday" required>
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
                        <input type="hidden" name="employee_id" id="employee_id">
                        <input type="text" name="total_leave" id="total_leave" required class="form-control">
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
            <?php echo e(Form::close()); ?>

        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    $("ul#hrm").siblings('a').attr('aria-expanded', 'true');
    $("ul#hrm").addClass("show");
    $("ul#hrm #employee-menu").addClass("active");

    var employee_id = [];
    var user_verified = <?php echo json_encode(env('USER_VERIFIED')) ?>;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function confirmDelete() {
        if (confirm("Are you sure want to delete?")) {
            return true;
        }
        return false;
    }

    $('.edit-btn').on('click', function() {
        $("#editModal select[name='company_name']").val($(this).data('company_name'));
        $("#editModal input[name='employee_id']").val($(this).data('id'));
        $("#editModal input[name='name']").val($(this).data('name'));
        $("#editModal input[name='father_name']").val($(this).data('father_name'));
        $("#editModal input[name='mother_name']").val($(this).data('mother_name'));
        $("#editModal select[name='division_branch']").val($(this).data('division_branch'));
        $("#editModal input[name='national_id']").val($(this).data('national_id'));
        $("#editModal select[name='department_id']").val($(this).data('department_id'));
        $("#editModal select[name='marital_status']").val($(this).data('marital_status'));
        $("#editModal input[name='employee_code']").val($(this).data('employee_code'));
        $("#editModal select[name='religion']").val($(this).data('religion'));
        $("#editModal input[name='date_of_birth']").val($(this).data('date_of_birth'));
        $("#editModal select[name='blood_group']").val($(this).data('blood_group'));
        $("#editModal select[name='gender']").val($(this).data('gender'));
        $("#editModal input[name='nationality']").val($(this).data('nationality'));
        $("#editModal textarea[name='present_address']").val($(this).data('present_address'));
        $("#editModal select[name='present_city']").val($(this).data('present_city'));
        $("#editModal select[name='present_district']").val($(this).data('present_district'));
        $("#editModal textarea[name='permanent_address']").val($(this).data('permanent_address'));
        $("#editModal select[name='permanent_city']").val($(this).data('permanent_city'));
        $("#editModal select[name='permanent_district']").val($(this).data('permanent_district'));
        $("#editModal input[name='office_phone_number']").val($(this).data('office_phone_number'));
        $("#editModal input[name='emergency_contact1']").val($(this).data('emergency_contact1'));
        $("#editModal input[name='emergency_contact2']").val($(this).data('emergency_contact2'));
        $("#editModal input[name='relationship']").val($(this).data('relationship'));
        $("#editModal input[name='joining_date']").val($(this).data('joining_date'));
        $("#editModal input[name='present_salary']").val($(this).data('present_salary'));
        $("#editModal select[name='position']").val($(this).data('position'));
        $("#editModal select[name='attendance_required']").val($(this).data('attendance_required'));
        $("#editModal input[name='work_starting_time']").val($(this).data('work_starting_time'));
        $("#editModal input[name='work_ending_time']").val($(this).data('work_ending_time'));
        $("#editModal input[name='late_count']").val($(this).data('late_count'));
        $("#editModal input[name='early_count']").val($(this).data('early_count'));
        $("#editModal select[name='logout_required']").val($(this).data('logout_required'));
        $("#editModal select[name='shift']").val($(this).data('shift'));
        $("#editModal select[name='half_day_absent']").val($(this).data('half_day_absent'));
        $("#editModal select[name='grade']").val($(this).data('grade'));
        $("#editModal select[name='qualification']").val($(this).data('qualification'));
        $("#editModal select[name='type_of_employee']").val($(this).data('type_of_employee'));
        $("#editModal select[name='overtime_count']").val($(this).data('overtime_count'));
        $("#editModal input[name='effective_date']").val($(this).data('effective_date'));
        $("#editModal select[name='weekly_holiday']").val($(this).data('weekly_holiday'));
        $("#editModal input[name='total_leave']").val($(this).data('total_leave'));
        $("#editModal input[name='email']").val($(this).data('email'));
        $("#editModal input[name='phone_number']").val($(this).data('phone_number'));
        $("#editModal input[name='address']").val($(this).data('address'));
        $("#editModal input[name='city']").val($(this).data('city'));
        $("#editModal input[name='country']").val($(this).data('country'));
        $('.selectpicker').selectpicker('refresh');
        console.log($(this).data('id'))
    });

    $('#employee-table').DataTable({
        "order": [],
        'language': {
            'lengthMenu': '_MENU_ <?php echo e(trans("file.records per page")); ?>',
            "info": '<small><?php echo e(trans("file.Showing")); ?> _START_ - _END_ (_TOTAL_)</small>',
            "search": '<?php echo e(trans("file.Search")); ?>',
            'paginate': {
                'previous': '<i class="dripicons-chevron-left"></i>',
                'next': '<i class="dripicons-chevron-right"></i>'
            }
        },
        'columnDefs': [{
                "orderable": false,
                'targets': [0, 1, 6]
            },
            {
                'render': function(data, type, row, meta) {
                    if (type === 'display') {
                        data = '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                    }

                    return data;
                },
                'checkboxes': {
                    'selectRow': true,
                    'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>'
                },
                'targets': [0]
            }
        ],
        'select': {
            style: 'multi',
            selector: 'td:first-child'
        },
        'lengthMenu': [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        dom: '<"row"lfB>rtip',
        buttons: [{
                extend: 'pdf',
                text: '<?php echo e(trans("file.PDF")); ?>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible',
                    stripHtml: false
                },
                customize: function(doc) {
                    for (var i = 1; i < doc.content[1].table.body.length; i++) {
                        if (doc.content[1].table.body[i][0].text.indexOf('<img src=') !== -1) {
                            var imagehtml = doc.content[1].table.body[i][0].text;
                            var regex = /<img.*?src=['"](.*?)['"]/;
                            var src = regex.exec(imagehtml)[1];
                            var tempImage = new Image();
                            tempImage.src = src;
                            var canvas = document.createElement("canvas");
                            canvas.width = tempImage.width;
                            canvas.height = tempImage.height;
                            var ctx = canvas.getContext("2d");
                            ctx.drawImage(tempImage, 0, 0);
                            var imagedata = canvas.toDataURL("image/png");
                            delete doc.content[1].table.body[i][0].text;
                            doc.content[1].table.body[i][0].image = imagedata;
                            doc.content[1].table.body[i][0].fit = [30, 30];
                        }
                    }
                },
            },
            {
                extend: 'csv',
                text: '<?php echo e(trans("file.CSV")); ?>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible',
                    format: {
                        body: function(data, row, column, node) {
                            if (column === 0 && (data.indexOf('<img src=') != -1)) {
                                var regex = /<img.*?src=['"](.*?)['"]/;
                                data = regex.exec(data)[1];
                            }
                            return data;
                        }
                    }
                },
            },
            {
                extend: 'print',
                text: '<?php echo e(trans("file.Print")); ?>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible',
                    stripHtml: false
                },
            },
            {
                text: '<?php echo e(trans("file.delete")); ?>',
                className: 'buttons-delete',
                action: function(e, dt, node, config) {
                    // if (user_verified == '1') {
                        employee_id.length = 0;
                        $(':checkbox:checked').each(function(i) {
                            if (i) {
                                employee_id[i - 1] = $(this).closest('tr').data('id');
                            }
                        });
                        if (employee_id.length && confirm("Are you sure want to delete?")) {
                            $.ajax({
                                type: 'POST',
                                url: 'employees/deletebyselection',
                                data: {
                                    employeeIdArray: employee_id
                                },
                                success: function(data) {
                                    alert(data);
                                }
                            });
                            dt.rows({
                                page: 'current',
                                selected: true
                            }).remove().draw(false);
                        } else if (!employee_id.length)
                            alert('No employee is selected!');
                    // } else
                    //     alert('This feature is disable for demo!');
                }
            },
            {
                extend: 'colvis',
                text: '<?php echo e(trans("file.Column visibility")); ?>',
                columns: ':gt(0)'
            },
        ],
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bdtech_new\resources\views/employee/index.blade.php ENDPATH**/ ?>