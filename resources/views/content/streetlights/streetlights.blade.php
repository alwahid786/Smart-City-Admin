@php
use Carbon\Carbon;
function convertDate($date) {
        return Carbon::parse($date)->format('d-m-Y h:i A');
    }
@endphp
@extends('layouts/contentNavbarLayout')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@section('title', 'Street Lights - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
<script>
  function openEditStreetlight(recordId) {
    console.log(recordId);
    console.log(recordId);
    console.log(recordId);
    console.log(recordId);
    $.ajax({
    url: '/fetchStreetlight/' + recordId,
    type: 'GET',
    success: function(data) {
        $('#name').val(data.name);
        $('#energy_consumed').val(data.energy_consumed);
        $('#schedule').val(data.schedule);
        $('#timezone').val(data.timezone);
        $('#last_contact').val(data.last_contact);
        $('#brightness_level').val(data.brightness_level);
        if (data.status == 'on') {  $('#status').prop("checked", true); } else { $('#status').prop("checked", false); }
        if (data.power_status == 'OK') {  $('#power_status').prop("checked", true); } else { $('#power_status').prop("checked", false); }
        if (data.device_status == 'OK') {  $('#device_status').prop("checked", true); } else { $('#device_status').prop("checked", false); }
        if (data.street_light_status == 'CS - ON') {  $('#street_light_status').prop("checked", true); } else { $('#street_light_status').prop("checked", false); }
        if (data.lamp_status == 'OK') {  $('#lamp_status').prop("checked", true); } else { $('#lamp_status').prop("checked", false); }
        if (data.knockdown_status == 'ON') {  $('#knockdown_status').prop("checked", true); } else { $('#knockdown_status').prop("checked", false); }
        if (data.photocell_mode_on == 'ON') {  $('#photocell_mode_on').prop("checked", true); } else { $('#photocell_mode_on').prop("checked", false); }
        if (data.photocell_mode_off == 'ON') {  $('#photocell_mode_off').prop("checked", true); } else { $('#photocell_mode_off').prop("checked", false); }
        if (data.beacon_control == 'ON') {  $('#beacon_control').prop("checked", true); } else { $('#beacon_control').prop("checked", false); }

        $('#streetlightid').val(recordId);

        $('#editStreetlight').modal('show');
        }
    });
  }

  function openEditLampCurrent(recordId, lamp) {
    $.ajax({
    url: '/fetchLampCurrent/' + recordId + '/' + lamp,
    type: 'GET',
    success: function(data) {
        $('#LampModalHeadingText').text('Update Lamp ' + lamp)
        $('#now').val(data.now);
        $('#min').val(data.min);
        $('#max').val(data.max);
        $('#avg').val(data.avg);
        
        $('#LampCurrentid').val(recordId);

        $('#editLampCurrent').modal('show');
    }
    });
  }

//   function openEditWasteRemoval(recordId) {
//     $.ajax({
//     url: '/fetchWasteRemoval/' + recordId,
//     type: 'GET',
//     success: function(data) {
//       $('#day_1').val(data.day_1);
//       $('#day_2').val(data.day_2);
//       $('#day_3').val(data.day_3);
//       $('#day_4').val(data.day_4);
//       $('#day_5').val(data.day_5);
//       $('#day_6').val(data.day_6);
//       $('#day_7').val(data.day_7);
//       $('#day_8').val(data.day_8);
//       $('#day_9').val(data.day_9);
//       $('#day_10').val(data.day_10);
//       $('#day_11').val(data.day_11);
//       $('#day_12').val(data.day_12);
//       $('#day_13').val(data.day_13);
//       $('#day_14').val(data.day_14);
//       $('#day_15').val(data.day_15);
//       $('#day_16').val(data.day_16);
//       $('#day_17').val(data.day_17);
//       $('#day_18').val(data.day_18);
//       $('#day_19').val(data.day_19);
//       $('#day_20').val(data.day_20);
//       $('#day_21').val(data.day_21);
//       $('#day_22').val(data.day_22);
//       $('#day_23').val(data.day_23);
//       $('#day_24').val(data.day_24);
//       $('#day_25').val(data.day_25);
//       $('#day_26').val(data.day_26);
//       $('#day_27').val(data.day_27);
//       $('#day_28').val(data.day_28);
//       $('#day_29').val(data.day_29);
//       $('#day_30').val(data.day_30);

//       $('#WasteRemovalid').val(recordId);
//       // $('#dustbin_id').val(data.dustbin_id);

//       $('#editWasteRemoval').modal('show');
//     }
//     });
//   }

//   function openEditRepairCost(recordId) {
//     $.ajax({
//     url: '/fetchRepairCost/' + recordId,
//     type: 'GET',
//     success: function(data) {
//       $('#jan').val(data.jan);
//       $('#feb').val(data.feb);
//       $('#mar').val(data.mar);
//       $('#apr').val(data.apr);
//       $('#may').val(data.may);
//       $('#jun').val(data.jun);
//       $('#jul').val(data.jul);
//       $('#aug').val(data.aug);
//       $('#sep').val(data.sep);
//       $('#oct').val(data.oct);
//       $('#nov').val(data.nov);
//       $('#dec').val(data.dec);

//       $('#RepairCostid').val(recordId);

//       $('#editRepairCost').modal('show');
//     }
//     });
//   }

//   function openEditMaintenanceCost(recordId) {
//     $.ajax({
//     url: '/fetchMaintenanceCost/' + recordId,
//     type: 'GET',
//     success: function(data) {
//       $('#jan1').val(data.jan);
//       $('#feb1').val(data.feb);
//       $('#mar1').val(data.mar);
//       $('#apr1').val(data.apr);
//       $('#may1').val(data.may);
//       $('#jun1').val(data.jun);
//       $('#jul1').val(data.jul);
//       $('#aug1').val(data.aug);
//       $('#sep1').val(data.sep);
//       $('#oct1').val(data.oct);
//       $('#nov1').val(data.nov);
//       $('#dec1').val(data.dec);

//       $('#MaintenanceCostid').val(recordId);

//       $('#editMaintenanceCost').modal('show');
//     }
//     });
//   }

//   function openEditResponseTime(recordId) {
//     $.ajax({
//     url: '/fetchResponseTime/' + recordId,
//     type: 'GET',
//     success: function(data) {
//       $('#1_hr').val(data['1_hr']);
//       $('#2_hr').val(data['2_hr']);
//       $('#4_hr').val(data['4_hr']);
//       $('#4_plus_hr').val(data['4_plus_hr']);

//       $('#ResponseTimeid').val(recordId);

//       $('#editResponseTime').modal('show');
//     }
//     });
//   }

//   function openEditSatisfiedPublic(recordId) {
//     $.ajax({
//     url: '/fetchPublicSatisfaction/' + recordId,
//     type: 'GET',
//     success: function(data) {
//       $('#jan2').val(data.jan);
//       $('#feb2').val(data.feb);
//       $('#mar2').val(data.mar);
//       $('#apr2').val(data.apr);
//       $('#may2').val(data.may);
//       $('#jun2').val(data.jun);
//       $('#jul2').val(data.jul);
//       $('#aug2').val(data.aug);
//       $('#sep2').val(data.sep);
//       $('#oct2').val(data.oct);
//       $('#nov2').val(data.nov);
//       $('#dec2').val(data.dec);

//       $('#PublicSatisfactionid').val(recordId);

//       $('#editSatisfiedPublic').modal('show');
//     }
//     });
//   }

//   function openEditWasteBreakdown(recordId) {
//     $.ajax({
//     url: '/fetchWasteBreakdown/' + recordId,
//     type: 'GET',
//     success: function(data) {
//       $('#organic_waste').val(data['organic_waste']);
//       $('#bottles_cans').val(data['bottles_cans']);
//       $('#paper_packaging').val(data['paper_packaging']);
//       $('#cardboard').val(data['cardboard']);
//       $('#other_waste').val(data['other_waste']);

//       $('#WasteBreakdownid').val(recordId);

//       $('#editWasteBreakdown').modal('show');
//     }
//     });
//   }
</script>
@endsection

@section('content')

@if (!$streetLightId)

<div class="card">
    <h5 class="card-header text-bolder">Street Lights Data</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead class="table-border-bottom-1 table-primary">
                <tr class="text-center text-nowrap">
                    <th>Name</th>
                    <th>Status</th>
                    <th>Energy Consumed</th>
                    <th>Schedule</th>
                    <th>Power Status</th>
                    <th>Device Status</th>
                    <th>Timezone</th>
                    <th>Last Contact</th>
                    <th>Street Light Status</th>
                    <th>Lamp Status</th>
                    <th>Knockdown Status</th>
                    <th>Brightness Level</th>
                    <th>Photocell Mode ON</th>
                    <th>Photocell Mode OFF</th>
                    <th>Beacon Control</th>
                    <th>Details</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($formattedLamps as $formattedLamp)
                <tr class="text-center text-nowrap">
                    <td><span class="fw-medium">{{ $formattedLamp['name'] }}</span></td>
                    <td><span>{{ $formattedLamp['status'] }}</span></td>
                    <td><span>{{ $formattedLamp['energy_consumed'] }}</span></td>
                    <td><span>{{ $formattedLamp['schedule'] }}</span></td>
                    <td><span>{{ $formattedLamp['power_status'] }}</span></td>
                    <td><span>{{ $formattedLamp['device_status'] }}</span></td>
                    <td><span>{{ $formattedLamp['timezone'] }}</span></td>
                    <td><span>{{ convertDate($formattedLamp['last_contact']) }}</span></td>
                    <td><span>{{ $formattedLamp['street_light_status'] }}</span></td>
                    <td><span>{{ $formattedLamp['lamp_status'] }}</span></td>
                    <td><span>{{ $formattedLamp['knockdown_status'] }}</span></td>
                    <td><span>{{ $formattedLamp['brightness_level'] }}</span></td>
                    <td><span>{{ $formattedLamp['photocell_mode_on'] }}</span></td>
                    <td><span>{{ $formattedLamp['photocell_mode_off'] }}</span></td>
                    <td><span>{{ $formattedLamp['beacon_control'] }}</span></td>
                    <td><a class="btn btn-primary btn-sm text-white"
                        href="{{ route('streetlight-details', $formattedLamp['id']) }}">View</a></td>
                    <td><a class="btn btn-success btn-sm text-white"
                        onclick="openEditStreetlight({{ $formattedLamp['id'] }})">Update</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Street Light Table Modal --}}
<div class="modal fade" id="editStreetlight" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Update Street Light</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('streetlight-update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" class="form-control" name="name" required>
                            <input type="hidden" name="id" id="streetlightid">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="energy_consumed" class="form-label">Energy Consumed</label>
                            <input type="text" id="energy_consumed" class="form-control" name="energy_consumed" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="schedule" class="form-label">Schedule</label>
                            <input type="text" id="schedule" class="form-control" name="schedule" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="timezone" class="form-label">Timezone</label>
                            <input type="text" id="timezone" class="form-control" name="timezone" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="last_contact" class="form-label">Last Contact</label>
                            <input type="text" id="last_contact" class="form-control" name="last_contact" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="brightness_level" class="form-label">Brightness Level</label>
                            <input type="text" id="brightness_level" class="form-control" name="brightness_level" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Status</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" id="status" style="transform: scale(1.5); margin-left: 5px;" name="status" value="on">
                                <label class="form-check-label" style="margin-left: 15px;">ON or OFF</label>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="power_status" class="form-label">Power Status</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" id="power_status" style="transform: scale(1.5); margin-left: 5px;" name="power_status" value="OK">
                                <label class="form-check-label" style="margin-left: 15px;">OK or NOT</label>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="device_status" class="form-label">Device Status</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" id="device_status" style="transform: scale(1.5); margin-left: 5px;" name="device_status" value="OK">
                                <label class="form-check-label" style="margin-left: 15px;">OK or NOT</label>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="street_light_status" class="form-label">Street Light Status</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" id="street_light_status" style="transform: scale(1.5); margin-left: 5px;" name="street_light_status" value="CS - ON">
                                <label class="form-check-label" style="margin-left: 15px;">CS-ON or OFF</label>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="lamp_status" class="form-label">Lamp Status</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" id="lamp_status" style="transform: scale(1.5); margin-left: 5px;" name="lamp_status" value="OK">
                                <label class="form-check-label" style="margin-left: 15px;">OK or NOT</label>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="knockdown_status" class="form-label">Knockdown Status</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" id="knockdown_status" style="transform: scale(1.5); margin-left: 5px;" name="knockdown_status" value="ON">
                                <label class="form-check-label" style="margin-left: 15px;">ON or OFF</label>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="photocell_mode_on" class="form-label">Photocell Mode On</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" id="photocell_mode_on" style="transform: scale(1.5); margin-left: 5px;" name="photocell_mode_on" value="ON">
                                <label class="form-check-label" style="margin-left: 15px;">ON or OFF</label>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="photocell_mode_off" class="form-label">Photocell Mode Off</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" id="photocell_mode_off" style="transform: scale(1.5); margin-left: 5px;" name="photocell_mode_off" value="ON">
                                <label class="form-check-label" style="margin-left: 15px;">ON or OFF</label>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="beacon_control" class="form-label">Beacon Control</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" id="beacon_control" style="transform: scale(1.5); margin-left: 5px;" name="beacon_control" value="ON">
                                <label class="form-check-label" style="margin-left: 15px;">ON or OFF</label>
                            </div>
                        </div>
                        
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

@elseif ($streetLightId)
{{-- Lamp Current Table --}}
<div class="card mb-4">
    <h5 class="card-header text-bolder">Lamp Current Data</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead class="table-border-bottom-1 table-primary">
                <tr class="text-center">
                    <th>Now</th>
                    <th>Minimum</th>
                    <th>Maximum</th>
                    <th>Average</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($LampCurrents as $lampcurrent)
                <tr class="text-center">
                    <td><span class="fw-medium">{{ $lampcurrent['now'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampcurrent['min'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampcurrent['max'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampcurrent['avg'] }}</span></td>
                    <td><button class="btn btn-success btn-sm text-white" data-bs-toggle="modal"
                            onclick="openEditLampCurrent({{ $lampcurrent['id'] }}, 'Current')">Update</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Lamp Voltage Table --}}
<div class="card mb-4">
    <h5 class="card-header text-bolder">Lamp Voltage Data</h5>
    <div class="table-responsive text-nowrap">
        <table id="dustbintable" class="table table-hover">
            <thead class="table-border-bottom-1 table-primary">
                <tr class="text-center">
                    <th>Now</th>
                    <th>Minimum</th>
                    <th>Maximum</th>
                    <th>Average</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($LampVoltages as $lampvoltage)
                <tr class="text-center">
                    <td><span class="fw-medium">{{ $lampvoltage['now'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampvoltage['min'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampvoltage['max'] }}</span></td>
                    <td><span class="fw-medium">{{ $lampvoltage['avg'] }}</span></td>
                    <td><button class="btn btn-success btn-sm text-white" data-bs-toggle="modal"
                            onclick="openEditLampCurrent({{ $lampvoltage['id'] }}, 'Voltage')">Update</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{-- Waste Removal Table --}}
{{-- <div class="card mb-4">
    <h5 class="card-header text-bolder">Waste Removal</h5>
    <div class="table-responsive text-nowrap">
        <table id="dustbintable" class="table table-hover">
            @foreach ($bin_waste_removals as $bin_waste_removal)
            <thead class="table-border-bottom-1 table-primary">
                <tr class="text-center">
                    <th>Day 1</th>
                    <th>Day 2</th>
                    <th>Day 3</th>
                    <th>Day 4</th>
                    <th>Day 5</th>
                    <th>Day 6</th>
                    <th>Day 7</th>
                    <th>Day 8</th>
                    <th>Day 9</th>
                    <th>Day 10</th>
                    <th class=border-bottom-0></th>
                </tr>
                <tr class="text-center">
                    <th>Day 11</th>
                    <th>Day 12</th>
                    <th>Day 13</th>
                    <th>Day 14</th>
                    <th>Day 15</th>
                    <th>Day 16</th>
                    <th>Day 17</th>
                    <th>Day 18</th>
                    <th>Day 19</th>
                    <th>Day 20</th>
                    <th class="border-bottom-0">Action</th>

                </tr>
                <tr class="text-center">
                    <th>Day 21</th>
                    <th>Day 22</th>
                    <th>Day 23</th>
                    <th>Day 24</th>
                    <th>Day 25</th>
                    <th>Day 26</th>
                    <th>Day 27</th>
                    <th>Day 28</th>
                    <th>Day 29</th>
                    <th>Day 30</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                <tr class="text-center">
                    <td><span class="fw-medium">{{ $bin_waste_removal['day_1'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_waste_removal['day_2'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_waste_removal['day_3'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_waste_removal['day_4'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_waste_removal['day_5'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_waste_removal['day_6'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_waste_removal['day_7'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_waste_removal['day_8'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_waste_removal['day_9'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_waste_removal['day_10'] }}</span></td>
                </tr>
                <tr class="text-center">
                    <td><span class="fw-medium">{{ $bin_waste_removal['day_11'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_waste_removal['day_12'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_waste_removal['day_13'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_waste_removal['day_14'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_waste_removal['day_15'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_waste_removal['day_16'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_waste_removal['day_17'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_waste_removal['day_18'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_waste_removal['day_19'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_waste_removal['day_20'] }}</span></td>
                    <td class="border-bottom-0"><a class="btn btn-primary btn-sm text-white"
                            onclick="openEditWasteRemoval({{ $bin_waste_removal['id'] }})">Update</a></span></td>
                </tr>
                <tr class="text-center">
                    <td><span class="fw-medium">{{ $bin_waste_removal['day_21'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_waste_removal['day_22'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_waste_removal['day_23'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_waste_removal['day_24'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_waste_removal['day_25'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_waste_removal['day_26'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_waste_removal['day_27'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_waste_removal['day_28'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_waste_removal['day_29'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_waste_removal['day_30'] }}</span></td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
</div> --}}
{{-- Dustbin Repair Cost --}}
{{-- <div class="card mb-4">
    <h5 class="card-header text-bolder">Repair Cost</h5>
    <div class="table-responsive text-nowrap">
        <table id="dustbintable" class="table table-hover">
            <thead class="table-border-bottom-1 table-primary">
                <tr class="text-center">
                    <th>Jan</th>
                    <th>Feb</th>
                    <th>March</th>
                    <th>April</th>
                    <th>May</th>
                    <th>June</th>
                    <th>July</th>
                    <th>Aug</th>
                    <th>Sep</th>
                    <th>Oct</th>
                    <th>Nov</th>
                    <th>Dec</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($bin_repair_costs as $bin_repair_cost)
                <tr class="text-center">
                    <td><span class="fw-medium">{{ $bin_repair_cost['jan'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_repair_cost['feb'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_repair_cost['mar'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_repair_cost['apr'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_repair_cost['may'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_repair_cost['jun'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_repair_cost['jul'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_repair_cost['aug'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_repair_cost['sep'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_repair_cost['oct'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_repair_cost['nov'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_repair_cost['dec'] }}</span></td>
                    <td><a class="btn btn-primary btn-sm text-white"
                            onclick="openEditRepairCost({{ $bin_repair_cost['id'] }})">Update</a></span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div> --}}
{{-- Dustbin Maintenance Cost --}}
{{-- <div class="card mb-4">
    <h5 class="card-header text-bolder">Maintainance Cost</h5>
    <div class="table-responsive text-nowrap">
        <table id="dustbintable" class="table table-hover">
            <thead class="table-border-bottom-1 table-primary">
                <tr class="text-center">
                    <th>Jan</th>
                    <th>Feb</th>
                    <th>March</th>
                    <th>April</th>
                    <th>May</th>
                    <th>June</th>
                    <th>July</th>
                    <th>Aug</th>
                    <th>Sep</th>
                    <th>Oct</th>
                    <th>Nov</th>
                    <th>Dec</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($bin_maintenance_costs as $bin_maintain_cost)
                <tr class="text-center">
                    <td><span class="fw-medium">{{ $bin_maintain_cost['jan'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_maintain_cost['feb'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_maintain_cost['mar'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_maintain_cost['apr'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_maintain_cost['may'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_maintain_cost['jun'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_maintain_cost['jul'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_maintain_cost['aug'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_maintain_cost['sep'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_maintain_cost['oct'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_maintain_cost['nov'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_maintain_cost['dec'] }}</span></td>
                    <td><a class="btn btn-primary btn-sm text-white"
                            onclick="openEditMaintenanceCost({{ $bin_maintain_cost['id'] }})">Update</a></span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div> --}}
{{-- Dustbin Response Time --}}
{{-- <div class="card mb-4">
    <h5 class="card-header text-bolder">Response Time</h5>
    <div class="table-responsive text-nowrap">
        <table id="dustbintable" class="table table-hover">
            <thead class="table-border-bottom-1 table-primary">
                <tr class="text-center">
                    <th>1 Hour</th>
                    <th>2 Hours</th>
                    <th>4 Hours</th>
                    <th>4 Plus Hours</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($bin_response_times as $bin_response_time)
                <tr class="text-center">
                    <td><span class="fw-medium">{{ $bin_response_time['1_hr'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_response_time['2_hr'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_response_time['4_hr'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_response_time['4_plus_hr'] }}</span></td>
                    <td><a class="btn btn-primary btn-sm text-white"
                            onclick="openEditResponseTime({{ $bin_response_time['id'] }})">Update</a></span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div> --}}
{{-- Dustbin Satisfied Public --}}
{{-- <div class="card mb-4">
    <h5 class="card-header text-bolder">Satisfied Public</h5>
    <div class="table-responsive text-nowrap">
        <table id="dustbintable" class="table table-hover">
            <thead class="table-border-bottom-1 table-primary">
                <tr class="text-center">
                    <th>Jan</th>
                    <th>Feb</th>
                    <th>March</th>
                    <th>April</th>
                    <th>May</th>
                    <th>June</th>
                    <th>July</th>
                    <th>Aug</th>
                    <th>Sep</th>
                    <th>Oct</th>
                    <th>Nov</th>
                    <th>Dec</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($bin_satisfied_publics as $bin_satisfied_public)
                <tr class="text-center">
                    <td><span class="fw-medium">{{ $bin_satisfied_public['jan'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_satisfied_public['feb'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_satisfied_public['mar'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_satisfied_public['apr'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_satisfied_public['may'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_satisfied_public['jun'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_satisfied_public['jul'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_satisfied_public['aug'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_satisfied_public['sep'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_satisfied_public['oct'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_satisfied_public['nov'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_satisfied_public['dec'] }}</span></td>
                    <td><a class="btn btn-primary btn-sm text-white"
                            onclick="openEditSatisfiedPublic({{ $bin_satisfied_public['id'] }})">Update</a></span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div> --}}
{{-- Dustbin Waste Breakdown --}}
{{-- <div class="card mb-4">
    <h5 class="card-header text-bolder">Waste Breakdown</h5>
    <div class="table-responsive text-nowrap">
        <table id="dustbintable" class="table table-hover">
            <thead class="table-border-bottom-1 table-primary">
                <tr class="text-center">
                    <th>Organic Waste</th>
                    <th>Bottles Cans</th>
                    <th>Paper Packaging</th>
                    <th>Cardboard</th>
                    <th>Other Waste</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($bin_waste_breakdowns as $bin_waste_breakdown)
                <tr class="text-center">
                    <td><span class="fw-medium">{{ $bin_waste_breakdown['organic_waste'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_waste_breakdown['bottles_cans'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_waste_breakdown['paper_packaging'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_waste_breakdown['cardboard'] }}</span></td>
                    <td><span class="fw-medium">{{ $bin_waste_breakdown['other_waste'] }}</span></td>
                    <td><a class="btn btn-primary btn-sm text-white"
                            onclick="openEditWasteBreakdown({{ $bin_waste_breakdown['id'] }})">Update</a></span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div> --}}


{{-- Streetlights Detailed Tables Modal --}}
{{-- Lamp Current Update Modal --}}
<div class="modal fade" id="editLampCurrent" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="LampModalHeadingText"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('lamp-current-update') }}" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-6 mb-3">
                            <label for="now" class="form-label">Now</label>
                            <input type="text" id="now" class="form-control" name="now" required>
                            <input type="hidden" name="id" id="LampCurrentid">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="min" class="form-label">Minimum</label>
                            <input type="text" id="min" class="form-control" name="min" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="max" class="form-label">Maximum</label>
                            <input type="text" id="max" class="form-control" name="max" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="avg" class="form-label">Average</label>
                            <input type="text" id="avg" class="form-control" name="avg" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

{{-- Waste Removal Update Modal --}}
{{-- <div class="modal fade" id="editWasteRemoval" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Update Bin Waste Removal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dustbin-waste-removal') }}" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-3 mb-3">
                            <label for="day_1" class="form-label">Day 1</label>
                            <input type="text" id="day_1" class="form-control" name="day_1" required>
                            <input type="hidden" name="id" id="WasteRemovalid">
                        </div>
                        <div class="col-3 mb-3">
                            <label for="day_2" class="form-label">Day 2</label>
                            <input type="text" id="day_2" class="form-control" name="day_2" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="day_3" class="form-label">Day 3</label>
                            <input type="text" id="day_3" class="form-control" name="day_3" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="day_4" class="form-label">Day 4</label>
                            <input type="text" id="day_4" class="form-control" name="day_4" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="day_5" class="form-label">Day 5</label>
                            <input type="text" id="day_5" class="form-control" name="day_5" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="day_6" class="form-label">Day 6</label>
                            <input type="text" id="day_6" class="form-control" name="day_6" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="day_7" class="form-label">Day 7</label>
                            <input type="text" id="day_7" class="form-control" name="day_7" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="day_8" class="form-label">Day 8</label>
                            <input type="text" id="day_8" class="form-control" name="day_8" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="day_9" class="form-label">Day 9</label>
                            <input type="text" id="day_9" class="form-control" name="day_9" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="day_10" class="form-label">Day 10</label>
                            <input type="text" id="day_10" class="form-control" name="day_10" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="day_11" class="form-label">Day 11</label>
                            <input type="text" id="day_11" class="form-control" name="day_11" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="day_12" class="form-label">Day 12</label>
                            <input type="text" id="day_12" class="form-control" name="day_12" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="day_13" class="form-label">Day 13</label>
                            <input type="text" id="day_13" class="form-control" name="day_13" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="day_14" class="form-label">Day 14</label>
                            <input type="text" id="day_14" class="form-control" name="day_14" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="day_15" class="form-label">Day 15</label>
                            <input type="text" id="day_15" class="form-control" name="day_15" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="day_16" class="form-label">Day 16</label>
                            <input type="text" id="day_16" class="form-control" name="day_16" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="day_17" class="form-label">Day 17</label>
                            <input type="text" id="day_17" class="form-control" name="day_17" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="day_18" class="form-label">Day 18</label>
                            <input type="text" id="day_18" class="form-control" name="day_18" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="day_19" class="form-label">Day 19</label>
                            <input type="text" id="day_19" class="form-control" name="day_19" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="day_20" class="form-label">Day 20</label>
                            <input type="text" id="day_20" class="form-control" name="day_20" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="day_21" class="form-label">Day 21</label>
                            <input type="text" id="day_21" class="form-control" name="day_21" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="day_22" class="form-label">Day 22</label>
                            <input type="text" id="day_22" class="form-control" name="day_22" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="day_23" class="form-label">Day 23</label>
                            <input type="text" id="day_23" class="form-control" name="day_23" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="day_24" class="form-label">Day 24</label>
                            <input type="text" id="day_24" class="form-control" name="day_24" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="day_25" class="form-label">Day 25</label>
                            <input type="text" id="day_25" class="form-control" name="day_25" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="day_26" class="form-label">Day 26</label>
                            <input type="text" id="day_26" class="form-control" name="day_26" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="day_27" class="form-label">Day 27</label>
                            <input type="text" id="day_27" class="form-control" name="day_27" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="day_28" class="form-label">Day 28</label>
                            <input type="text" id="day_28" class="form-control" name="day_28" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="day_29" class="form-label">Day 29</label>
                            <input type="text" id="day_29" class="form-control" name="day_29" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="day_30" class="form-label">Day 30</label>
                            <input type="text" id="day_30" class="form-control" name="day_30" required>
                        </div>

                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div> --}}

{{-- Repair Cost Update Modal --}}
{{-- <div class="modal fade" id="editRepairCost" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Update Repair Cost</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('repair-cost-update') }}" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-3 mb-3">
                            <label for="jan" class="form-label">Janaury</label>
                            <input type="text" id="jan" class="form-control" name="jan" required>
                            <input type="hidden" name="id" id="RepairCostid">
                        </div>
                        <div class="col-3 mb-3">
                            <label for="feb" class="form-label">February</label>
                            <input type="text" id="feb" class="form-control" name="feb" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="mar" class="form-label">March</label>
                            <input type="text" id="mar" class="form-control" name="mar" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="apr" class="form-label">April</label>
                            <input type="text" id="apr" class="form-control" name="apr" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="may" class="form-label">May</label>
                            <input type="text" id="may" class="form-control" name="may" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="jun" class="form-label">June</label>
                            <input type="text" id="jun" class="form-control" name="jun" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="jul" class="form-label">July</label>
                            <input type="text" id="jul" class="form-control" name="jul" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="aug" class="form-label">August</label>
                            <input type="text" id="aug" class="form-control" name="aug" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="sep" class="form-label">September</label>
                            <input type="text" id="sep" class="form-control" name="sep" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="oct" class="form-label">October</label>
                            <input type="text" id="oct" class="form-control" name="oct" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="nov" class="form-label">November</label>
                            <input type="text" id="nov" class="form-control" name="nov" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="dec" class="form-label">Decemeber</label>
                            <input type="text" id="dec" class="form-control" name="dec" required>
                        </div>

                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div> --}}

{{-- Maintenance Cost Update Modal --}}
{{-- <div class="modal fade" id="editMaintenanceCost" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Update Maintenance Cost</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('maintenance-cost-update') }}" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-3 mb-3">
                            <label for="jan1" class="form-label">Janaury</label>
                            <input type="text" id="jan1" class="form-control" name="jan" required>
                            <input type="hidden" name="id" id="MaintenanceCostid">
                        </div>
                        <div class="col-3 mb-3">
                            <label for="feb1" class="form-label">February</label>
                            <input type="text" id="feb1" class="form-control" name="feb" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="mar1" class="form-label">March</label>
                            <input type="text" id="mar1" class="form-control" name="mar" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="apr1" class="form-label">April</label>
                            <input type="text" id="apr1" class="form-control" name="apr" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="may1" class="form-label">May</label>
                            <input type="text" id="may1" class="form-control" name="may" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="jun1" class="form-label">June</label>
                            <input type="text" id="jun1" class="form-control" name="jun" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="jul1" class="form-label">July</label>
                            <input type="text" id="jul1" class="form-control" name="jul" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="aug1" class="form-label">August</label>
                            <input type="text" id="aug1" class="form-control" name="aug" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="sep1" class="form-label">September</label>
                            <input type="text" id="sep1" class="form-control" name="sep" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="oct1" class="form-label">October</label>
                            <input type="text" id="oct1" class="form-control" name="oct" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="nov1" class="form-label">November</label>
                            <input type="text" id="nov1" class="form-control" name="nov" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="dec1" class="form-label">Decemeber</label>
                            <input type="text" id="dec1" class="form-control" name="dec" required>
                        </div>

                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div> --}}

{{-- Response Time Update Modal --}}
{{-- <div class="modal fade" id="editResponseTime" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Update Response Time</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('response-time-update') }}" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-6 mb-3">
                            <label for="1_hr" class="form-label">1 Hour</label>
                            <input type="text" id="1_hr" class="form-control" name="1_hr" required>
                            <input type="hidden" name="id" id="ResponseTimeid">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="2_hr" class="form-label">2 Hours</label>
                            <input type="text" id="2_hr" class="form-control" name="2_hr" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="4_hr" class="form-label">4 Hours</label>
                            <input type="text" id="4_hr" class="form-control" name="4_hr" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="4_plus_hr" class="form-label">4 Plus Hours</label>
                            <input type="text" id="4_plus_hr" class="form-control" name="4_plus_hr" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div> --}}

{{-- Public Satisfaction Update Modal --}}
{{-- <div class="modal fade" id="editSatisfiedPublic" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Update Public Satisfaction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('public-satisfaction-update') }}" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-3 mb-3">
                            <label for="jan2" class="form-label">Janaury</label>
                            <input type="text" id="jan2" class="form-control" name="jan" required>
                            <input type="hidden" name="id" id="PublicSatisfactionid">
                        </div>
                        <div class="col-3 mb-3">
                            <label for="feb2" class="form-label">February</label>
                            <input type="text" id="feb2" class="form-control" name="feb" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="mar2" class="form-label">March</label>
                            <input type="text" id="mar2" class="form-control" name="mar" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="apr2" class="form-label">April</label>
                            <input type="text" id="apr2" class="form-control" name="apr" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="may2" class="form-label">May</label>
                            <input type="text" id="may2" class="form-control" name="may" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="jun2" class="form-label">June</label>
                            <input type="text" id="jun2" class="form-control" name="jun" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="jul2" class="form-label">July</label>
                            <input type="text" id="jul2" class="form-control" name="jul" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="aug2" class="form-label">August</label>
                            <input type="text" id="aug2" class="form-control" name="aug" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="sep2" class="form-label">September</label>
                            <input type="text" id="sep2" class="form-control" name="sep" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="oct2" class="form-label">October</label>
                            <input type="text" id="oct2" class="form-control" name="oct" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="nov2" class="form-label">November</label>
                            <input type="text" id="nov2" class="form-control" name="nov" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="dec2" class="form-label">Decemeber</label>
                            <input type="text" id="dec2" class="form-control" name="dec" required>
                        </div>

                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div> --}}

{{-- Response Time Update Modal --}}
{{-- <div class="modal fade" id="editWasteBreakdown" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Update Waste Breakdown</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('waste-breakdown-update') }}" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-6 mb-3">
                            <label for="organic_waste" class="form-label">Organic Waste</label>
                            <input type="text" id="organic_waste" class="form-control" name="organic_waste" required>
                            <input type="hidden" name="id" id="WasteBreakdownid">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="bottles_cans" class="form-label">Bottles & cans</label>
                            <input type="text" id="bottles_cans" class="form-control" name="bottles_cans" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="paper_packaging" class="form-label">Paper Packaging</label>
                            <input type="text" id="paper_packaging" class="form-control" name="paper_packaging"
                                required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="cardboard" class="form-label">Cardboard</label>
                            <input type="text" id="cardboard" class="form-control" name="cardboard" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="other_waste" class="form-label">Other Waste</label>
                            <input type="text" id="other_waste" class="form-control" name="other_waste" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div> --}}
@endif

@endsection