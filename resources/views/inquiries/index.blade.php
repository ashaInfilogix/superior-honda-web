@extends('layouts.my-account')

@section('my-account')
    <h2 class="account__content--title h3 mb-20">Inquiries History</h2>
    <div class="account__table--area">
        <table class="account__table">
            <thead class="account__table--header">
                <tr class="account__table--header__child">
                    <th class="account__table--header__child--items">#</th>
                    <th class="account__table--header__child--items">Name</th>
                    <th class="account__table--header__child--items">Date</th>
                    <th class="account__table--header__child--items">Vehicle</th>
                    <th class="account__table--header__child--items">Year</th>
                    <th class="account__table--header__child--items">Status</th>	 	 	 	
                </tr>
            </thead>
            <tbody class="account__table--body mobile__none">
                @foreach($inquiries as $key => $inquiry)
                <tr class="account__table--body__child">
                    <td class="account__table--body__child--items">{{ ++$key }}</td>
                    <td class="account__table--body__child--items">{{ $inquiry->name }}</td>
                    <td class="account__table--body__child--items">{{ $inquiry->date }}</td>
                    <td class="account__table--body__child--items">{{ $inquiry->vehicle }}</td>
                    <td class="account__table--body__child--items">{{ $inquiry->year }}</td>
                    @if($inquiry->status != 'Completed')
                        <td class="account__table--body__child--items">{{ $inquiry->status }}</td>
                    @elseif ($inquiry->status == 'Completed' && $inquiry->inspectionStatus == 'Pending')
                        <td class="account__table--body__child--items">Moved for Inspection</td>
                    @elseif($inquiry->inspectionStatus != 'Completed')
                        <td class="account__table--body__child--items">{{ $inquiry->inspectionStatus }}</td>
                    @elseif ($inquiry->inspectionStatus == 'Completed' && $inquiry->job == 'Pending')
                        <td class="account__table--body__child--items">Moved for Job</td>
                    @elseif($inquiry->job != 'Completed')
                        <td class="account__table--body__child--items">{{ $inquiry->job }}</td>
                    @else 
                        <td class="account__table--body__child--items">Inquiry Closed</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
            <tbody class="account__table--body mobile__block">
                @foreach($inquiries as $key => $inquiry)
                    <tr class="account__table--body__child">
                        <td class="account__table--body__child--items">
                            <strong>Name</strong>
                            <span>{{ $inquiry->name }}</span>
                        </td>
                        <td class="account__table--body__child--items">
                            <strong>Date</strong>
                            <span>{{ $inquiry->date }}</span>
                        </td>
                        <td class="account__table--body__child--items">
                            <strong>Vehicle</strong>
                            <span>{{ $inquiry->vehicle }}</span>
                        </td>
                        <td class="account__table--body__child--items">
                            <strong>Year</strong>
                            <span>{{ $inquiry->year }}</span>
                        </td>
                        <td class="account__table--body__child--items">
                            <strong>Status</strong>
                            @if($inquiry->status != 'Completed')
                                <span>{{ $inquiry->status }}</span>
                            @elseif ($inquiry->status == 'Completed' && $inquiry->inspectionStatus == 'Pending')
                                <span>Moved for Inspection</span>
                            @elseif($inquiry->inspectionStatus != 'Completed')
                                <span>{{ $inquiry->inspectionStatus }}</span>
                            @elseif ($inquiry->inspectionStatus == 'Completed' && $inquiry->job == 'Pending')
                                <span>Moved for Job</span>
                            @elseif($inquiry->job != 'Completed')
                                <span>{{ $inquiry->job }}</span>
                            @else 
                                <span>Inquiry Closed</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection