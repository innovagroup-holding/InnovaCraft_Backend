@extends('layouts.app')


@section('content')
    <div class="" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Service Form</h3>
                </div>

                <div class="title_right">

                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Pleas Fill This Form<small></small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                        aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a class="dropdown-item" href="#">Settings 1</a>
                                        </li>
                                        <li><a class="dropdown-item" href="#">Settings 2</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"
                                action="{{ route('service.update', $service->id) }}" enctype="multipart/form-data"
                                method="post">
                                @csrf

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Service Name
                                        in English <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="name" required="required" class="form-control  "
                                            name="en_name" value="{{ $service->en_name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Service Name
                                        in Dutch <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="name" required="required" class="form-control  "
                                            name="nl_name" value="{{ $service->nl_name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align"
                                        for="description">Description in English
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="description" required="required" class="form-control "
                                            name="en_description" value="{{ $service->en_description }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align"
                                        for="description">Description in Dutch
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="description" required="required" class="form-control "
                                            name="nl_description" value="{{ $service->nl_description }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">Title of
                                        Requirment in English
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="description" required="required" class="form-control "
                                            name="en_title_of_requirments" value="{{ $service->en_title_of_requirments }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">Title of
                                        Requirment in Dutch
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="description" required="required" class="form-control "
                                            name="nl_title_of_requirments"
                                            value="{{ $service->nl_title_of_requirments }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">Title of
                                        How it Works in English
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="description" required="required" class="form-control "
                                            name="en_title_of_how_it_works"
                                            value="{{ $service->en_title_of_how_it_works }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">Title of
                                        How it Works in Dutch
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="description" required="required" class="form-control "
                                            name="nl_title_of_how_it_works"
                                            value="{{ $service->nl_title_of_how_it_works }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">Title of
                                        Service Benefit in English
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="description" required="required" class="form-control "
                                            name="en_title_of_service_benefit"
                                            value="{{ $service->en_title_of_service_benefit }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">Title of
                                        Service Benefit in Dutch
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="description" required="required" class="form-control "
                                            name="nl_title_of_service_benefit"
                                            value="{{ $service->nl_title_of_service_benefit }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="call_to_action" class="col-form-label col-md-3 col-sm-3 label-align">Title
                                        Call To Action
                                        in English
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="call_to_action" class="form-control col" type="text"
                                            name="en_title_call_to_action"
                                            value="{{ $service->en_title_call_to_action }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="call_to_action" class="col-form-label col-md-3 col-sm-3 label-align">Title
                                        Call To Action
                                        in Dutch
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="call_to_action" class="form-control col" type="text"
                                            name="nl_title_call_to_action"
                                            value="{{ $service->nl_title_call_to_action }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="call_to_action"
                                        class="col-form-label col-md-3 col-sm-3 label-align">SubTitle Call To
                                        Action in English
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="call_to_action" class="form-control col" type="text"
                                            name="en_sub_title_call_to_action"
                                            value="{{ $service->en_sub_title_call_to_action }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="call_to_action"
                                        class="col-form-label col-md-3 col-sm-3 label-align">SubTitle Call To
                                        Action in Dutch
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="call_to_action" class="form-control col" type="text"
                                            name="nl_sub_title_call_to_action"
                                            value="{{ $service->nl_sub_title_call_to_action }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Cost
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="cost" class="date-picker form-control" required="required"
                                            type="text" name="cost" value="{{ $service->cost }}">
                                    </div>
                                </div>

                                <br>
                                <h4>Images</h4>
                                <div class="existing-images">
                                    @foreach ($service->service_images as $image)
                                        <div class="image-container" id="image-{{ $image->id }}">
                                            <img src="{{ Storage::url($image['image_path']) }}" alt="Service Image"
                                                style="width: 100px; height: 100px;">
                                            <button type="button" class="btn btn-danger remove-image"
                                                data-id="{{ $image->id }}">Remove</button>
                                        </div>
                                    @endforeach
                                </div>

                                <h4>Add New Images</h4>
                                <div class="new-images">
                                    <input type="file" name="image_path[]" multiple>
                                </div>
                                <br>
                                <h2 class="StepTitle">Requirement</h2>
                                <div class="form-group row">
                                    <div id="requirements">
                                        @foreach ($service->requirment as $requirment)
                                            <div class="requirement">
                                                <label for="requirment[0][en_name]">English Name:</label>
                                                <input type="text" id="requirement[0][en_name]"
                                                    name="requirment[{{ $requirment->id }}][en_name]"
                                                    value="{{ $requirment->en_name }}" class="form-control  "><br>

                                                <label for="requirment[0][nl_name]">Dutch Name:</label>
                                                <input type="text" id="requirements[0][nl_name]"
                                                    name="requirment[{{ $requirment->id }}][nl_name]"
                                                    value="{{ $requirment->nl_name }}" class="form-control  "><br>

                                                <br>
                                                <label for="requirment[0][en_description]">English
                                                    Description:</label>
                                                <textarea id="requirement[0][en_description]" name="requirment[{{ $requirment->id }}][en_description]"
                                                    class="form-control  ">{{ $requirment->en_description }}</textarea><br>


                                                <label for="requirement[0][nl_description]">Dutch
                                                    Description:</label>
                                                <textarea id="requirement[0][nl_description]" name="requirment[{{ $requirment->id }}][nl_description]"
                                                    class="form-control  ">{{ $requirment->nl_description }}</textarea><br>
                                                <button type="button" class="delete-requirement">Delete
                                                    Requirement</button>
                                            </div>
                                            <br>
                                        @endforeach
                                    </div>

                                </div>

                                <button type="button" id="add-more">Add More Requirements</button>
                                <br>

                                <h2 class="StepTitle">Service Benefits</h2>
                                <div class="form-group row">
                                    <div id="service_benefits">
                                        @foreach ($service->service_benefits as $service_benefits)
                                            <div class="service_benefit">
                                                <label for="service_benefits[0][en_name]">English Name:</label>
                                                <input type="text" id="service_benefits[0][en_name]"
                                                    name="service_benefits[{{ $service_benefits->id }}][en_name]"
                                                    value="{{ $service_benefits->en_name }}" class="form-control  "><br>

                                                <label for="service_benefits[0][nl_name]">Dutch Name:</label>
                                                <input type="text" id="service_benefits[0][nl_name]"
                                                    name="service_benefits[{{ $service_benefits->id }}][nl_name]"
                                                    value="{{ $service_benefits->nl_name }}" class="form-control  "><br>
                                                <br>
                                                <label for="service_benefits[0][en_description]">English
                                                    Description:</label>
                                                <textarea id="service_benefits[0][en_description]"
                                                    name="service_benefits[{{ $service_benefits->id }}][en_description]" class="form-control  ">{{ $service_benefits->en_description }}</textarea><br>

                                                <label for="service_benefits[0][nl_description]">Dutch
                                                    Description:</label>
                                                <textarea id="service_benefits[0][nl_description]"
                                                    name="service_benefits[{{ $service_benefits->id }}][nl_description]" class="form-control  ">{{ $service_benefits->nl_description }}</textarea><br>
                                                <button type="button" class="delete-service_benefit">Delete
                                                    Benefit</button>

                                            </div>
                                            <br>
                                        @endforeach
                                    </div>
                                </div>
                                <button type="button" id="add-more-benefit">Add More Benefits</button>
                                <br>
                                <h2 class="StepTitle">Service Processes </h2>
                                <div id="service_processes">
                                    <h3>Service Processes</h3>
                                    @foreach ($service->service_processs as $service_processs)
                                        <div class="service_process">
                                            <label for="service_processs[0][en_name]">English Name:</label>
                                            <input type="text" id="service_processes[0][en_name]"
                                                name="service_processs[{{ $service_processs->id }}][en_name]"
                                                value="{{ $service_processs->en_name }}" class="form-control  "><br>


                                            <label for="service_processs[0][nl_name]">Dutch Name:</label>
                                            <input type="text" id="service_processes[0][nl_name]"
                                                name="service_processs[{{ $service_processs->id }}][nl_name]"
                                                value="{{ $service_processs->nl_name }}" class="form-control  "><br>


                                            <label for="service_processs[0][step_no]">Step Number:</label>
                                            <input type="number" id="service_processes[0][step_no]"
                                                name="service_processs[{{ $service_processs->id }}][step_no]"
                                                value="{{ $service_processs->step_no }}" class="form-control  "><br>
                                            <button type="button" class="delete-service_process">Delete
                                                Service Process</button>
                                            <div id="process_procedures">
                                                @foreach ($service_processs->process_procedures as $process_procedures)
                                                    <div class="process_procedure">
                                                        <label
                                                            for="service_processs[0][process_procedures][0][en_name]">Procedure
                                                            English Name:</label>
                                                        <input type="text"
                                                            id="service_processes[0][process_procedures][0][en_name]"
                                                            name="service_processs[{{ $service_processs->id }}][process_procedures][{{ $process_procedures->id }}][en_name]"
                                                            value="{{ $process_procedures->en_name }}"
                                                            class="form-control  "><br>

                                                        <label
                                                            for="service_processs[0][process_procedures][0][nl_name]">Procedure
                                                            Dutch Name:</label>
                                                        <input type="text"
                                                            id="service_processes[0][process_procedures][0][nl_name]"
                                                            name="service_processs[{{ $service_processs->id }}][process_procedures][{{ $process_procedures->id }}][nl_name]"
                                                            value="{{ $process_procedures->nl_name }}"
                                                            class="form-control  "><br>


                                                        <label
                                                            for="service_processs[0][process_procedures][0][en_description]">Procedure
                                                            English Description:</label>
                                                        <textarea id="service_processes[0][process_procedures][0][en_description]"
                                                            name="service_processs[{{ $service_processs->id }}][process_procedures][{{ $process_procedures->id }}][en_description]"
                                                            class="form-control  ">{{ $process_procedures->en_description }}</textarea><br>


                                                        <label
                                                            for="service_processs[0][process_procedures][0][nl_description]">Procedure
                                                            Dutch Description:</label>
                                                        <textarea id="service_processes[0][process_procedures][0][nl_description]"
                                                            name="service_processs[{{ $service_processs->id }}][process_procedures][{{ $process_procedures->id }}][nl_description]"
                                                            class="form-control  ">{{ $process_procedures->nl_description }}</textarea><br>
                                                @endforeach
                                            </div>

                                            <button type="button" class="add-more-procedure"
                                                data-service-process-index="0">Add More Procedure</button>
                                        </div>
                                </div>
                                @endforeach
                        </div>
                    </div>
                    <button type="button" id="add-more-service-processes">Add More Service
                        Processes</button>

                    <br>
                    <h2 class="StepTitle">Client Testimonials</h2>
                    <div class="form-group row">
                        <div id="client_testimonials">
                            @foreach ($service->client_testimonial as $client)
                                <div class="client_testimonial">
                                    <label for="client_testimonial[0][client_name]">Client
                                        Name:</label>
                                    <input type="text" id="client_testimonial[0][client_name]"
                                        name="client_testimonial[{{ $client->id }}][client_name]"
                                        value="{{ $client->client_name }}" class="form-control  "><br>

                                    <br>
                                    <label for="client_testimonial[0][en_client_testimonial]">Client
                                        Testemonial
                                        in English</label>
                                    <textarea id="client_testimonial[0][en_client_testimonial]"
                                        name="client_testimonial[{{ $client->id }}][en_client_testimonial]" class="form-control  ">{{ $client->en_client_testimonial }}</textarea><br>

                                    <label for="client_testimonial[0][nl_client_testimonial]">Client
                                        Testemonial
                                        in Dutch
                                    </label>
                                    <textarea id="client_testimonial[0][nl_client_testimonial]"
                                        name="client_testimonial[{{ $client->id }}][nl_client_testimonial]" class="form-control  ">{{ $client->nl_client_testimonial }}</textarea><br>
                                    <button type="button" class="delete-client_testimonial">Delete
                                        Client Testimonial</button>
                                </div>
                                <br>
                            @endforeach

                        </div>
                    </div>
                    <button type="button" id="add-more-testimonial">Add More Testimonial</button>

                    <div class="ln_solid"></div>
                    <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                            <button class="btn btn-primary" type="button">Cancel</button>
                            <button class="btn btn-primary" type="reset">Reset</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>


    <script>
       
        document.getElementById('add-more').addEventListener('click', function() {
            var requirementsDiv = document.getElementById('requirements');
            var index1 = requirementsDiv.children.length - 1;
            var index = 1000;


            var newRequirement = document.createElement('div');
            newRequirement.className = 'requirement';

            newRequirement.innerHTML = `
            <h6>Requirment ${index1+1} </h6>
                <label for="requirement[${index}][en_name]">English Name:</label>
                <input type="text" id="requirement[${index}][en_name]" name="requirment[${index}][en_name]"  class="form-control  "><br>

                <label for="requirement[${index}][nl_name]">Dutch Name:</label>
                <input type="text" id="requirement[${index}][nl_name]" name="requirment[${index}][nl_name]"  class="form-control  "><br>

                <label for="requirement[${index}][en_description]">English Description:</label>
                <textarea id="requirement[${index}][en_description]" name="requirment[${index}][en_description]"  class="form-control  "></textarea><br>

                <label for="requirement[${index}][nl_description]">Dutch Description:</label>
                <textarea id="requirement[${index}][nl_description]" name="requirment[${index}][nl_description]"  class="form-control  "></textarea><br>
                <button type="button" class="delete-requirement">Delete Requirement</button>
            `;

            requirementsDiv.appendChild(newRequirement);
        });

        document.getElementById('add-more-benefit').addEventListener('click', function() {
            var service_benefitsDiv = document.getElementById('service_benefits');
            var index = service_benefitsDiv.children.length - 1;

            var newservice_benefit = document.createElement('div');
            newservice_benefit.className = 'service_benefit';

            newservice_benefit.innerHTML = `
            <h6>Service Benefit ${index+1} </h6>
                <label for="service_benefits[${index}][en_name]">English Name:</label>
                <input type="text" id="service_benefits[${index}][en_name]" name="service_benefits[${index}][en_name]"  class="form-control  "><br>

                <label for="service_benefits[${index}][nl_name]">Dutch Name:</label>
                <input type="text" id="service_benefits[${index}][nl_name]" name="service_benefits[${index}][nl_name]"  class="form-control  "><br>

                <label for="service_benefits[${index}][en_description]">English Description:</label>
                <textarea id="service_benefits[${index}][en_description]" name="service_benefits[${index}][en_description]"  class="form-control  "></textarea><br>

                <label for="service_benefits[${index}][nl_description]">Dutch Description:</label>
                <textarea id="service_benefits[${index}][nl_description]" name="service_benefits[${index}][nl_description]"  class="form-control  "></textarea><br>
                <button type="button" class="delete-service_benefit">Delete Benefit</button>
            `;

            service_benefitsDiv.appendChild(newservice_benefit);
        });
        document.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('delete-service_benefit')) {
                event.target.closest('.service_benefit').remove();
            }
        });



        document.getElementById('add-more-service-processes').addEventListener('click', function() {
            var serviceProcessesDiv = document.getElementById('service_processes');
            var index = serviceProcessesDiv.children.length;

            var newServiceProcess = document.createElement('div');
            newServiceProcess.className = 'service_process';

            newServiceProcess.innerHTML = `
            <h6>Service Process ${index+1} </h6>
                <label for="service_processes[${index}][en_name]">English Name:</label>
                <input type="text" id="service_processes[${index}][en_name]" name="service_processs[${index}][en_name]"  class="form-control  "><br>

                <label for="service_processs[${index}][nl_name]">Dutch Name:</label>
                <input type="text" id="service_processes[${index}][nl_name]" name="service_processs[${index}][nl_name]"  class="form-control  "><br>

                <label for="service_processes[${index}][step_no]">Step Number:</label>
                <input type="number" id="service_processes[${index}][step_no]" name="service_processs[${index}][step_no]"  class="form-control  "><br>

                <div class="process_procedure">
                    <label for="service_processes[${index}][process_procedures][0][en_name]">Procedure English Name:</label>
                    <input type="text" id="service_processes[${index}][process_procedures][0][en_name]" name="service_processs[${index}][process_procedures][0][en_name]"  class="form-control  "><br>

                    <label for="service_processes[${index}][process_procedures][0][nl_name]">Procedure Dutch Name:</label>
                    <input type="text" id="service_processes[${index}][process_procedures][0][nl_name]" name="service_processs[${index}][process_procedures][0][nl_name]"  class="form-control  "><br>

                    <label for="service_processes[${index}][process_procedures][0][en_description]">Procedure English Description:</label>
                    <textarea id="service_processes[${index}][process_procedures][0][en_description]" name="service_processs[${index}][process_procedures][0][en_description]"  class="form-control  "></textarea><br>

                    <label for="service_processes[${index}][process_procedures][0][nl_description]">Procedure Dutch Description:</label>
                    <textarea id="service_processes[${index}][process_procedures][0][nl_description]" name="service_processs[${index}][process_procedures][0][nl_description]"  class="form-control  "></textarea><br>
                    <button type="button" class="delete-service_process">Delete
                                                        Service Process</button>
                    <button type="button" class="add-more-procedure" data-service-process-index="${index}">Add More Procedure</button>
                </div>
            `;

            serviceProcessesDiv.appendChild(newServiceProcess);
        });
        document.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('delete-service_process')) {
                event.target.closest('.service_process').remove();
            }
        });

        document.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('add-more-procedure')) {
                var serviceProcessIndex = event.target.getAttribute('data-service-process-index');
                var procedureDiv = event.target.parentNode;
                var procedureIndex = procedureDiv.querySelectorAll('textarea').length / 2;

                var newProcedure = document.createElement('div');
                newProcedure.innerHTML = `
                <h6>Process Procedures  </h6>
                    <label for="service_processes[${serviceProcessIndex}][process_procedures][${procedureIndex}][en_name]">Procedure English Name:</label>
                    <input type="text" id="service_processes[${serviceProcessIndex}][process_procedures][${procedureIndex}][en_name]" name="service_processs[${serviceProcessIndex}][process_procedures][${procedureIndex}][en_name]"  class="form-control  "><br>

                    <label for="service_processes[${serviceProcessIndex}][process_procedures][${procedureIndex}][nl_name]">Procedure Dutch Name:</label>
                    <input type="text" id="service_processes[${serviceProcessIndex}][process_procedures][${procedureIndex}][nl_name]" name="service_processs[${serviceProcessIndex}][process_procedures][${procedureIndex}][nl_name]"  class="form-control  "><br>

                    <label for="service_processes[${serviceProcessIndex}][process_procedures][${procedureIndex}][en_description]">Procedure English Description:</label>
                    <textarea id="service_processes[${serviceProcessIndex}][process_procedures][${procedureIndex}][en_description]" name="service_processs[${serviceProcessIndex}][process_procedures][${procedureIndex}][en_description]"  class="form-control  "></textarea><br>

                    <label for="service_processes[${serviceProcessIndex}][process_procedures][${procedureIndex}][nl_description]">Procedure Dutch Description:</label>
                    <textarea id="service_processes[${serviceProcessIndex}][process_procedures][${procedureIndex}][nl_description]" name="service_processs[${serviceProcessIndex}][process_procedures][${procedureIndex}][nl_description]"  class="form-control  "></textarea><br>
                    <button type="button" class="delete-process_procedures">Delete
                        Process Procedures</button>
                `;

                procedureDiv.appendChild(newProcedure);
            }
        });
        document.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('delete-process_procedures')) {
                event.target.closest('.process_procedure').remove();
            }
        });
        //////////////////////)))))
        document.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('delete-requirement')) {
                event.target.closest('.requirement').remove();
            }
        });

        document.getElementById('add-more-testimoniale').addEventListener('click', function() {
            console.log("DDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD");
            var client_testimonialsDiv = document.getElementById('client_testimonials');
            var index = client_testimonialsDiv.children.length;
            console.log(index);

            var newclient_testimonial = document.createElement('div');
            newclient_testimonial.className = 'client_testimonial';

            newclient_testimonial.innerHTML = `
            <h6>Client Testimonial ${index+1} </h6>
                <label for="client_testimonial[${index}][client_name]">Client Name:</label>
                <input type="text" id="client_testimonial[${index}][client_name]" name="client_testimonial[${index}][client_name]" class="form-control  "><br>

                <label for="client_testimonial[${index}][en_client_testimonial]"> Client Testemonial in English</label>
                <textarea id="client_testimonial[${index}][en_client_testimonial]" name="client_testimonial[${index}][en_client_testimonial]" class="form-control  "></textarea><br>

                <label for="client_testimonial[${index}][nl_client_testimonial]">Client Testemonial in Dutch</label>
                <textarea id="client_testimonial[${index}][nl_client_testimonial]" name="client_testimonial[${index}][nl_client_testimonial]" class="form-control  "></textarea><br>
                <button type="button" class="delete-client_testimonial">Delete Client Testimonial</button>
            `;

            client_testimonialsDiv.appendChild(newclient_testimonial);
        });
        document.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('delete-client_testimonial')) {
                event.target.closest('.client_testimonial').remove();
            }
        });

        document.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('delete-requirement')) {
                event.target.closest('.requirement').remove();
            }
        });
    </script>
@endsection