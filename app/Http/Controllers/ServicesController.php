<?php

namespace App\Http\Controllers;

use App\Models\BenefitsForWho;
use App\Models\ClientTestimonialService;
use App\Models\HowItWork;
use App\Models\Project;
use App\Models\Requirment;
use App\Models\Service;
use App\Models\ServiceImage;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ServicesController extends Controller
{



    public function index(Request $request)
    {
        $language = $request->header('Accept-Language');
        $defaultLanguage = 'en';
        $locale = $language ? substr($language, 0, 2) : $defaultLanguage;

        $services = Service::with(['requirment', 'service_benefits', 'service_processs', 'client_testimonial'])->get();

        if ($services->isEmpty()) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => __('app.there_is_no_data')
            ], 200);
        }

        try {
            $processedServices = $services->map(function ($service) use ($locale) {

                $data = [
                    'id' => $service->id,
                    'name' => $locale == 'en' ? $service->en_name : $service->nl_name,
                    'description' => $locale == 'en' ? $service->en_description : $service->nl_description,

                ];

                return $data;
            });

            return response()->json([
                'success' => 1,
                'result' => $processedServices,
                'message' => __('app.data_returnd_sucssesfully')
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    ///////////////////////////////////////////////////////////////

    public function show_all()
    {
        $language = App::getLocale();
        $defaultLanguage = 'en';
        $locale = $language ? substr($language, 0, 2) : $defaultLanguage;
        $services = Service::with(['requirment', 'service_benefits', 'service_processs', 'client_testimonial'])->get();
        $processedServices = $services->map(function ($service) use ($locale) {

            $data = [
                'id' => $service->id,
                'name' => $locale == 'en' ? $service->en_name : $service->nl_name,
                'description' => $locale == 'en' ? $service->en_description : $service->nl_description,
            ];
            return $data;
        });
        return view('admin.Service.service', compact('processedServices'));
    }
    ////////////////////////////////////////////////////////////////

    public function store(Request $request)
    {

        $validatedDat = Validator::make($request->all(), [
            'en_name' => 'required',
            'nl_name' => 'required',
            'en_description' => 'required',
            'nl_description' => 'required',
            'en_title_of_requirments' => 'required',
            'nl_title_of_requirments' => 'required',
            'en_title_of_how_it_works' => 'required',
            'nl_title_of_how_it_works' => 'required',
            'en_title_of_service_benefit' => 'required',
            'nl_title_of_service_benefit' => 'required',
            'en_title_call_to_action' => 'required',
            'nl_title_call_to_action' => 'required',
            'en_sub_title_call_to_action' => 'required',
            'nl_sub_title_call_to_action' => 'required',
            "cost" => 'required',
            'requirment' => 'array',
            'client_testimonial' => 'array',
            'service_benefits' => 'array',
            'service_processs' => 'array',
            'image_path.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',




        ]);
        if ($validatedDat->fails()) {

            /*return response()->json([
                'sucsess' => 0,
                'result' => null,
                'message' => $validatedDat->errors(),
            ], 200);*/
            return redirect()->route('service.add')->with('error', $validatedDat->errors());
        }

        DB::beginTransaction();

        try {
            $validatedData = $request->all(); //$validatedData['']

            $service = Service::create([
                'en_name' => $validatedData['en_name'],
                'nl_name' => $validatedData['nl_name'],
                'en_description' => $validatedData['en_description'],
                'nl_description' => $validatedData['nl_description'],
                'en_title_of_requirments' => $validatedData['en_title_of_requirments'],
                'nl_title_of_requirments' => $validatedData['nl_title_of_requirments'],
                'en_title_of_how_it_works' => $validatedData['en_title_of_how_it_works'],
                'nl_title_of_how_it_works' => $validatedData['nl_title_of_how_it_works'],
                'en_title_of_service_benefit' => $validatedData['en_title_of_service_benefit'],
                'nl_title_of_service_benefit' => $validatedData['nl_title_of_service_benefit'],
                'en_title_call_to_action' => $validatedData['en_title_call_to_action'],
                'nl_title_call_to_action' => $validatedData['nl_title_call_to_action'],
                'en_sub_title_call_to_action' => $validatedData['en_sub_title_call_to_action'],
                'nl_sub_title_call_to_action' => $validatedData['nl_sub_title_call_to_action'],
                'cost' => $validatedData['cost']

            ]);

            if ($request->hasFile('image_path')) {
                foreach ($request->file('image_path') as $file) {
                    if (!$file->isValid()) {
                        return "A";
                    }
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('Service_images', $filename, 'public');
                    $service->service_images()->create([
                        'image_path' => $filePath,
                    ]);
                }
            }

            if (isset($validatedData['requirment'])) {
                foreach ($validatedData['requirment'] as $relatedData) {

                    $service->requirment()->create($relatedData);
                }
            }

            if (isset($validatedData['service_benefits'])) {
                foreach ($validatedData['service_benefits'] as $relatedData) {
                    $service->service_benefits()->create($relatedData);
                }
            }
            /* if (isset($validatedData['client_testimonial'])) {
                foreach ($validatedData['client_testimonial'] as $index=> $relatedData) {
                    if ($request->hasFile("client_testimonial.$index.image_src")) {

                     //   return "A";            ///////////isset($relatedData->image_src)
                      //  $file = $request->file("client_testimonial.$index.image_src"); //$relatedData['image_src'];
                      //  $filename = time() . '_' . $file->getClientOriginalName();
                       // $filePath = $file->storeAs('client_images', $filename, 'public');
                      // $ImagePath = $request->file("client_testimonial.$index.image_src")->store('ffff_images', 'public');
                        $service->client_testimonial()->create([
                            'client_name' => $relatedData->client_name,
                      //      'image_src' => $ImagePath//$filePath
                        ]);
                    } else {
                        $service->client_testimonial()->create($relatedData);
                    }
                }
            }*/
            if (isset($validatedData['client_testimonial'])) {
                foreach ($validatedData['client_testimonial'] as $index => $ffffData) {
                    $ffffImagePath = null;

                    // Check for FFFF image upload using the index
                    if ($request->hasFile("client_testimonial.$index.image_src")) {
                        $ffffImagePath = $request->file("client_testimonial.$index.image_src")->store('Client_images', 'public');
                    }

                    $service->client_testimonial()->create([
                        'client_name' => $ffffData['client_name'],
                        'en_client_testimonial' => $ffffData['en_client_testimonial'],
                        'nl_client_testimonial' => $ffffData['nl_client_testimonial'],
                        'image_src' => $ffffImagePath,
                    ]);
                }
            }


            if (!empty($validatedData['service_processs'])) {
                foreach ($validatedData['service_processs'] as $service_processsdata) {

                    $service_processs = $service->service_processs()->create([
                        'en_name' => $service_processsdata['en_name'],
                        'nl_name' => $service_processsdata['nl_name'],
                        'step_no' => $service_processsdata['step_no'],
                    ]);

                    if (!empty($service_processsdata['process_procedures'])) {
                        foreach ($service_processsdata['process_procedures'] as $process_procedures) {

                            $service_processs->process_procedures()->create([
                                'en_name' => $process_procedures['en_name'],
                                'nl_name' => $process_procedures['nl_name'],
                                'en_description' => $process_procedures['en_description'],
                                'nl_description' => $process_procedures['nl_description'],
                            ]);
                        }
                    }
                }
            }



            DB::commit();
            return redirect()->route('showall.service')->with('success', 'Service created successfully!');

            /*  return response()->json([
                'sucsess' => 1,
                'result' => $service,
                'message' => __('app.servive_stored_sucsessfully'),
            ], 200);*/
        } catch (Exception $e) {
            DB::rollBack();
            /* return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $e
            ], 200);*/
            return redirect()->route('service.add')->with('error', $e);
        }
    }



    ////////////////////////////////////////////////////////////////

    public function addservice()
    {
        return view('admin.Service.addtest');
    }


    ////////////////////////////////////////////////////////////////

    public function show($id, Request $request)
    {
        $language = $request->header('Accept-Language');
        $defaultLanguage = 'en';
        $locale = $language ? substr($language, 0, 2) : $defaultLanguage;

        try {
            $service = Service::with(['requirment', 'service_benefits', 'service_processs', 'client_testimonial'])->findOrFail($id);

            if (!$service) {
                return response()->json([
                    'success' => 0,
                    'result' => null,
                    'message' => __('app.there_is_no_data')
                ], 200);
            }

            $data = [
                'name' => $locale == 'en' ? $service->en_name : $service->nl_name,
                'description' => $locale == 'en' ? $service->en_description : $service->nl_description,
                'title_of_requirments' => $locale == 'en' ? $service->en_title_of_requirments : $service->nl_title_of_requirments,
                'title_of_how_it_works' => $locale == 'en' ? $service->en_title_of_how_it_works : $service->nl_title_of_how_it_works,
                'title_of_service_benefit' => $locale == 'en' ? $service->en_title_of_service_benefit : $service->nl_title_of_service_benefit,
                'title_call_to_action' => $locale == 'en' ? $service->en_title_call_to_action : $service->nl_title_call_to_action,
                'sub_title_call_to_action' => $locale == 'en' ? $service->en_sub_title_call_to_action : $service->nl_sub_title_call_to_action,
            ];

            // Process Requirments
            $data['requirments'] = $service->requirment->map(function ($related) use ($locale) {
                return [
                    'name' => $locale == 'en' ? $related->en_name : $related->nl_name,
                    'description' => $locale == 'en' ? $related->en_description : $related->nl_description,
                ];
            });

            // Process Service Benefits
            $data['service_benefits'] = $service->service_benefits->map(function ($related) use ($locale) {
                return [
                    'name' => $locale == 'en' ? $related->en_name : $related->nl_name,
                    'description' => $locale == 'en' ? $related->en_description : $related->nl_description,
                ];
            });

            // Process Client Testimonials
            $data['client_testimonial'] = $service->client_testimonial->map(function ($related) use ($locale) {
                return [
                    'client_name' => $related->client_name,
                    'client_testimonial' => $locale == 'en' ? $related->en_client_testimonial : $related->nl_client_testimonial,
                ];
            });


            // Process Service Processes and Procedures
            $data['service_processes'] = $service->service_processs->map(function ($related) use ($locale) {
                return [
                    'name' => $locale == 'en' ? $related->en_name : $related->nl_name,
                    'process_procedures' => $related->process_procedures->map(function ($subrelated) use ($locale) {
                        return [
                            'name' => $locale == 'en' ? $subrelated->en_name : $subrelated->nl_name,
                            'description' => $locale == 'en' ? $subrelated->en_description : $subrelated->nl_description,
                        ];
                    }),
                ];
            });

            return response()->json([
                'success' => 1,
                'result' => $data,
                'message' => __('app.service_returned_sucsessfully')
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    ////////////////////////////////////////////////////////////////

    public function edit($id)
    {
        $service = Service::with(['requirment', 'service_benefits', 'service_processs', 'client_testimonial'])->findOrFail($id);
        if ($service) {
            return view('admin.Service.editservice', compact('service'));
        } else {

            return redirect()->back();
        }
    }
    ////////////////////////////////////////////////////////////////
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'en_name' => 'required',
            'nl_name' => 'required',
            'en_description' => 'required',
            'nl_description' => 'required',
            'en_title_of_requirments' => 'required',
            'nl_title_of_requirments' => 'required',
            'en_title_of_how_it_works' => 'required',
            'nl_title_of_how_it_works' => 'required',
            'en_title_of_service_benefit' => 'required',
            'nl_title_of_service_benefit' => 'required',
            'en_title_call_to_action' => 'required',
            'nl_title_call_to_action' => 'required',
            'en_sub_title_call_to_action' => 'required',
            'nl_sub_title_call_to_action' => 'required',
            "cost" => 'required',
            'requirment' => 'array',
            'client_testimonial' => 'array',
            'service_benefits' => 'array',
            'service_processs' => 'array'
        ]);
        if ($validation->fails()) {
            $ser = Service::findOrFail($id);
            return redirect()->route('service.edit', $ser->id)->with('error', $validation->errors());
            /*  return   response()->json([
                'sucsess' => 0,
                'result' => null,
                'message' => $validation->errors(),
            ], 200);*/
        }
        DB::beginTransaction();
        try {
            $validatedData = $request->all();
            $service = Service::findOrFail($id);
            if ($service) {


                $service->en_name = $request['en_name'];
                $service->nl_name = $request['nl_name'];
                $service->en_description = $request['en_description'];
                $service->nl_description = $request['nl_description'];
                $service->en_title_of_requirments = $request['en_title_of_requirments'];
                $service->nl_title_of_requirments = $request['nl_title_of_requirments'];
                $service->en_title_of_how_it_works = $request['en_title_of_how_it_works'];
                $service->nl_title_of_how_it_works = $request['nl_title_of_how_it_works'];
                $service->en_title_of_service_benefit = $request['en_title_of_service_benefit'];
                $service->nl_title_of_service_benefit = $request['nl_title_of_service_benefit'];
                $service->en_title_call_to_action = $request['en_title_call_to_action'];
                $service->nl_title_call_to_action = $request['nl_title_call_to_action'];
                $service->en_sub_title_call_to_action = $request['en_sub_title_call_to_action'];
                $service->nl_sub_title_call_to_action = $request['nl_sub_title_call_to_action'];
                $service->cost = $request['cost'];
                $service->save();


                Requirment::where('service_id', $service->id)->delete();
                if (isset($validatedData['requirment'])) {
                    foreach ($validatedData['requirment'] as $relatedData) {

                        $service->requirment()->create($relatedData);
                    }
                }
                BenefitsForWho::where('service_id', $service->id)->delete();
                if (isset($validatedData['service_benefits'])) {
                    foreach ($validatedData['service_benefits'] as $relatedData) {
                        $service->service_benefits()->create($relatedData);
                    }
                }
              /*  ClientTestimonialService::where('service_id', $service->id)->delete();
                if (isset($validatedData['client_testimonial'])) {
                    foreach ($validatedData['client_testimonial'] as $relatedData) {
                        $service->client_testimonial()->create($relatedData);
                    }
                }*/
                ////////////////////////////////////////////////
                if (isset($validatedData['client_testimonial'])) {
                    foreach ($validatedData['client_testimonial'] as $index => $ffffData) {
                        if (isset($ffffData['id'])) {
                            if (isset($ffffData['_delete']) && $ffffData['_delete'] == 1) {

                                $ffff = ClientTestimonialService::findOrFail($ffffData['id']);
                                if ($ffff->image_path) {
                                    Storage::disk('public')->delete($ffff->image_path);
                                }
                                $ffff->delete();
                            } else {

                                $ffff = ClientTestimonialService::findOrFail($ffffData['id']);
                                $ffff->en_client_testimonial = $ffffData['en_client_testimonial'];
                                $ffff->nl_client_testimonial = $ffffData['nl_client_testimonial'];


                                if ($request->hasFile("client_testimonial.$index.image_src")) {
                                    if ($ffff->image_path) {
                                        Storage::disk('public')->delete($ffff->image_path);
                                    }
                                    $ffffImagePath = $request->file("client_testimonial.$index.image_src")->store('Client_images', 'public');
                                    $ffff->image_path = $ffffImagePath;
                                }

                                $ffff->save();
                            }
                        } else {

                            $ffffImagePath = null;
                            if ($request->hasFile("client_testimonial.$index.image_src")) {
                                $ffffImagePath = $request->file("client_testimonial.$index.image_src")->store('Client_images', 'public');
                            }

                            $service->client_testimonial()->create([
                                'client_name' => $ffffData['client_name'],
                                'en_client_testimonial' => $ffffData['en_client_testimonial'],
                                'nl_client_testimonial' => $ffffData['nl_client_testimonial'],
                                'image_src' => $ffffImagePath,
                            ]);
                        }
                    }
                }
                ////////////////////////////////////////////////
                HowItWork::where('service_id', $service->id)->delete();
                if (!empty($validatedData['service_processs'])) {
                    foreach ($validatedData['service_processs'] as $service_processsdata) {

                        $service_processs = $service->service_processs()->create([
                            'en_name' => $service_processsdata['en_name'],
                            'nl_name' => $service_processsdata['nl_name'],
                            'step_no' => $service_processsdata['step_no'],
                        ]);
                        if (!empty($service_processsdata['process_procedures'])) {
                            foreach ($service_processsdata['process_procedures'] as $process_procedures) {

                                $service_processs->process_procedures()->create([
                                    'en_name' => $process_procedures['en_name'],
                                    'nl_name' => $process_procedures['nl_name'],
                                    'en_description' => $process_procedures['en_description'],
                                    'nl_description' => $process_procedures['nl_description'],
                                ]);
                            }
                        }
                    }
                }
                if ($request->has('remove_images')) {
                    $removeImages = $request->input('remove_images');
                    foreach ($removeImages as $imageId) {
                        $image = ServiceImage::findOrFail($imageId);

                        Storage::delete('public/' . $image->path);

                        $image->delete();
                    }
                }
                if ($request->hasFile('image_path')) {
                    foreach ($request->file('image_path') as $file) {
                        if (!$file->isValid()) {
                            return "A";
                        }
                        $filename = time() . '_' . $file->getClientOriginalName();
                        $filePath = $file->storeAs('Service_images', $filename, 'public');
                        $service->service_images()->create([
                            'image_path' => $filePath
                        ]);
                    }
                }



                DB::commit();


                return redirect()->route('showall.service')->with('success', 'Service Updated successfully!');
            } else {
                return redirect()->route('showall.service')->with('error', 'Service Updated Faild!');
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('showall.service')->with('error', $e);
        }
    }
    ////////////////////////////////////////////////////////////////
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        if ($service) {
            $service->service_categories()->delete();
            $service->delete();

            return redirect()->route('showall.service')->with('success', "Service Deleted Sucsessfully");
        } else {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => __('app.faild_to_delete_service')
            ], 200);
        }
    }
    ////////////////////////////////////////////////////////////////


    public function view($id)
    {
        //  $local =App::getLocale();
        $language = App::getLocale();
        $defaultLanguage = 'en';
        $locale = $language ? substr($language, 0, 2) : $defaultLanguage;

        try {
            $service = Service::with(['requirment', 'service_benefits', 'service_processs', 'client_testimonial'])->findOrFail($id);

            if (!$service) {
                return response()->json([
                    'success' => 0,
                    'result' => null,
                    'message' => __('app.there_is_no_data')
                ], 200);
            }

            $data = [
                'id' => $service->id,
                'name' => $locale == 'en' ? $service->en_name : $service->nl_name,
                'description' => $locale == 'en' ? $service->en_description : $service->nl_description,
                'title_of_requirments' => $locale == 'en' ? $service->en_title_of_requirments : $service->nl_title_of_requirments,
                'title_of_how_it_works' => $locale == 'en' ? $service->en_title_of_how_it_works : $service->nl_title_of_how_it_works,
                'title_of_service_benefit' => $locale == 'en' ? $service->en_title_of_service_benefit : $service->nl_title_of_service_benefit,
                'title_call_to_action' => $locale == 'en' ? $service->en_title_call_to_action : $service->nl_title_call_to_action,
                'sub_title_call_to_action' => $locale == 'en' ? $service->en_sub_title_call_to_action : $service->nl_sub_title_call_to_action,
            ];

            // Process Requirments
            $data['requirments'] = $service->requirment->map(function ($related) use ($locale) {
                return [
                    'name' => $locale == 'en' ? $related->en_name : $related->nl_name,
                    'description' => $locale == 'en' ? $related->en_description : $related->nl_description,
                ];
            });

            // Process Service Benefits
            $data['service_benefits'] = $service->service_benefits->map(function ($related) use ($locale) {
                return [
                    'name' => $locale == 'en' ? $related->en_name : $related->nl_name,
                    'description' => $locale == 'en' ? $related->en_description : $related->nl_description,
                ];
            });
            $data['service_images'] = $service->service_images->map(function ($related) use ($locale) {
                return [
                    'image_path' => $related->image_path

                ];
            });

            // Process Client Testimonials
            $data['client_testimonial'] = $service->client_testimonial->map(function ($related) use ($locale) {
                return [
                    'client_name' => $related->client_name,
                    'client_testimonial' => $locale == 'en' ? $related->en_client_testimonial : $related->nl_client_testimonial,
                ];
            });

            // Process Service Processes and Procedures
            $data['service_processes'] = $service->service_processs->map(function ($related) use ($locale) {
                return [
                    'name' => $locale == 'en' ? $related->en_name : $related->nl_name,
                    'process_procedures' => $related->process_procedures->map(function ($subrelated) use ($locale) {
                        return [
                            'name' => $locale == 'en' ? $subrelated->en_name : $subrelated->nl_name,
                            'description' => $locale == 'en' ? $subrelated->en_description : $subrelated->nl_description,
                        ];
                    }),
                ];
            });
            return view('admin.Service.viewservice', compact('data'));
        } catch (Exception $e) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
