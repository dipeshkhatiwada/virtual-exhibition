<div class="modal fade" id="individualModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog individual_form" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Login with your registered Email & Password.</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" id="employee-login-form" action="<?php echo e(url('/employee/login')); ?>">
                                                    <?php echo csrf_field(); ?>

                                                    <div class="form-group row cm-row">
                                                        <span class="col-md-1 col-2 form_icon bluebg">
                                                            <i class="fa fa-user-circle"></i>
                                                        </span>
                                                        <input type="email" name="email" class="form-control col-md-11 col-10" id="individual_user" placeholder="Individual Username">
                                                    </div>
                                                    <div class="form-group row cm-row">
                                                        <span class="col-md-1 col-2 form_icon bluebg">
                                                            <i class="fa fa-key"></i>
                                                        </span>
                                                        <input type="password" name="password" class="form-control col-md-11 col-10" id="individual_password" placeholder="Individual Password">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="remember" type="checkbox" id="gridCheck1">
                                                            <label class="form-check-label ind_check_label" for="gridCheck1">
                                                                Remember me
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="button" id="individual-button" class="btn ind_bluebtn">Login</button>
                                                        <span class="float-right ind_forget"><a href="<?php echo e(url('employee/password')); ?>">Forgot your Password ?</a></span>
                                                    </div>  
                                                </form>
                                            </div>
                                            <div class="modal_footer">
                                                <p>If you don’t have an account, please create an account.</p>
                                                <div class="tb10m">
                                                    <a href="<?php echo e(url('/employee/register')); ?>" class="btn ind_signupbtn">Sign Up</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Individual button popup ended here -->
  <div class="modal fade" id="businessModal" tabindex="-1" role="dialog" aria-labelledby="businessModalLabel" aria-hidden="true">
                                    <div class="modal-dialog business_form" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Login with your registered Email & Password.</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="employer-login-form" method="POST" action="<?php echo e(url('/employer/login')); ?>">
                                                    <?php echo csrf_field(); ?>

                                                    <div class="form-group row cm-row">
                                                        <span class="col-md-1 col-2 form_icon greenbg">
                                                            <i class="fa fa-user-circle"></i>
                                                        </span>
                                                        <input type="text" name="email" class="form-control col-md-11 col-10" id="business_user" placeholder="Business Username">
                                                    </div>
                                                    <div class="form-group row cm-row">
                                                        <span class="col-md-1 col-2 form_icon greenbg">
                                                            <i class="fa fa-key"></i>
                                                        </span>
                                                        <input type="password" name="password" class="form-control col-md-11 col-10" id="business_password" placeholder="Business Password">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="remember" type="checkbox" id="gridCheck1">
                                                            <label class="form-check-label indivi_check_label" for="gridCheck1">
                                                                Remember me
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="button" id="business-button"  class="btn busi_greenbtn">Login</button>
                                                        <span class="float-right busi_forget"><a href="<?php echo e(url('employer/password')); ?>">Forgot your Password ?</a></span>
                                                    </div>  
                                                </form>
                                            </div>
                                            <div class="modal_footer">
                                                <p>If you don’t have an account, please create an account.</p>
                                                <div class="tb10m">
                                                    <a href="<?php echo e(url('/employer/register')); ?>" class="btn busi_signupbtn" >Sign Up</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/common/popuplogin.blade.php ENDPATH**/ ?>