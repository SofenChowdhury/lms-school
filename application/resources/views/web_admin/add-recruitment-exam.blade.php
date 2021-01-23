@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                 <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>Add {{ $title }}</h2>
                        </div>
                        <div class="col-lg-6" style="float: right;">
                            <a href="{{ route('students') }}" class="btn btn-primary pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <form id="basic-form" method="post" novalidate>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Name  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Guardian  </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="gaurdian" class="form-control">
                                        <option value="">Select Gaurdian </option>
                                        <option value="cheese">Cheese</option>
                                        <option value="tomatoes">Tomatoes</option>
                                        <option value="mozarella">Mozzarella</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Gender  </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="gender" class="form-control">
                                        <option value="">Select Gender </option>
                                        <option value="cheese">Cheese</option>
                                        <option value="tomatoes">Tomatoes</option>
                                        <option value="mozarella">Mozzarella</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Blood Group  </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="blood_group" class="form-control">
                                        <option value="">Select Blood Group </option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Date of Birth  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="date" name="birthday" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Religion  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="religion" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Phone  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="phone" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Address  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="address" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>State  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="state" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Country  </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="country" class="form-control">
                                        <option value="cheese">Cheese</option>
                                        <option value="tomatoes">Tomatoes</option>
                                        <option value="mozarella">Mozzarella</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Class   </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="class" class="form-control">
                                        <option value="">Select Class</option>
                                        <option value="cheese">Cheese</option>
                                        <option value="tomatoes">Tomatoes</option>
                                        <option value="mozarella">Mozzarella</option>
                                    </select>
                                </div>
                            </div>
                             <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Section    </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="section" class="form-control">
                                        <option value="">Select Section</option>
                                        <option value="cheese">Cheese</option>
                                        <option value="tomatoes">Tomatoes</option>
                                        <option value="mozarella">Mozzarella</option>
                                    </select>
                                </div>
                            </div>
                             <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Group    </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="group" class="form-control">
                                        <option value="">Select Group</option>
                                        <option value="cheese">Cheese</option>
                                        <option value="tomatoes">Tomatoes</option>
                                        <option value="mozarella">Mozzarella</option>
                                    </select>
                                </div>
                            </div>
                             <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Optional Subject    </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="op_subject" class="form-control">
                                        <option value="">Select ptional Subject</option>
                                        <option value="cheese">Cheese</option>
                                        <option value="tomatoes">Tomatoes</option>
                                        <option value="mozarella">Mozzarella</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Register NO *    </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="resgister_no" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Roll  *    </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="roll" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Photo  *    </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="file" name="file" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Extra Curricular Activities * </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="extracaricular" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Remarks  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text"  name="remarks" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Email as username  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" name="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Password  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" name="password" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Re-Type Password  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-default">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection