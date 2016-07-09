@extends('layouts.app')

@section('title', trans('project.features'))

@section('content')
@include('projects.partials.breadcrumb',['title' => trans('project.features')])

<h1 class="page-header">{{ $project->name }} <small>{{ trans('project.features') }}</small></h1>

@include('projects.partials.nav-tabs')

<div class="panel panel-default">
    <table class="table table-condensed">
        <thead>
            <th>{{ trans('app.table_no') }}</th>
            <th>{{ trans('feature.name') }}</th>
            <th class="text-center">{{ trans('feature.tasks_count') }}</th>
            <th class="text-center">{{ trans('feature.progress') }}</th>
            <th class="text-right">{{ trans('feature.price') }}</th>
            <th>{{ trans('feature.worker') }}</th>
            <th>{{ trans('app.action') }}</th>
        </thead>
        <tbody>
            @forelse($features as $key => $feature)
            <tr>
                <td>{{ 1 + $key }}</td>
                <td>{{ $feature->name }}</td>
                <td class="text-center">{{ $feature->tasks_count = rand(3, 7) }}</td>
                <td class="text-center">{{ $feature->progress = rand(70, 100) }} %</td>
                <td class="text-right">{{ formatRp($feature->price) }}</td>
                <td>{{ $feature->worker->name }}</td>
                <td>{!! link_to_route('features.show', trans('app.show'),[$feature->id],['class' => 'btn btn-info btn-xs']) !!}</td>
            </tr>
            @empty
            <tr><td colspan="7">{{ trans('feature.empty') }}</td></tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th class="text-right" colspan="2">Total</th>
                <th class="text-center">{{ $features->sum('tasks_count') }}</th>
                <th class="text-center">{{ formatDecimal($features->avg('progress')) }} %</th>
                <th class="text-right">{{ formatRp($features->sum('price')) }}</th>
                <th colspan="2"></th>
            </tr>
            <tr><td colspan="7">{!! html_link_to_route('features.create', trans('feature.create'), [$project->id], ['class' => 'btn btn-primary','icon' => 'plus']) !!}</td></tr>
        </tfoot>
    </table>
</div>
@endsection