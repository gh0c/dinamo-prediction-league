@extends('layouts.app')

@section('page_title', __('forms.mod.games._headings.result.edit') . ' ' . $game->homeTeam->name . ' - ' . $game->awayTeam->name)

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-lg-8 col-xl-6 offset-lg-2 offset-xl-3">

                <h3>{{ __('forms.mod.games._headings.result.update') }}</h3>


                <div class="row mt-2 mb-2 border-top pt-2">
                    @if($game->competition)
                        <div class="m-auto align-items-center d-flex">
                            <span>
                                @if($game->competition->featured_image)
                                    <img src="{{ $game->competition->logoUrl() }}"
                                         style="width: 44px; height: 44px; object-fit: contain"
                                         alt="{{ $game->competition->name }}"
                                         class="img-fluid m-auto">
                                @endif
                            </span>
                            <h4 class="d-inline-block ml-1 mb-0">{{ $game->competition->name }}</h4>
                        </div>
                    @endif
                </div>

                <div class="row mt-2">
                    <h5 class="m-auto">{{ $game->datetime->format('d.m.Y. H:i') }}</h5>
                </div>

                <div class="row mt-4">

                    <div class="col-6 text-center">
                        @if($game->homeTeam)
                            <span>
                                @if($game->homeTeam->featured_image)
                                    <img src="{{ $game->homeTeam->logoUrl() }}"
                                         style="width: 80px; height: 80px; object-fit: contain"
                                         alt="{{ $game->homeTeam->name }}"
                                         class="img-fluid m-auto">
                                @endif
                            </span>

                        @endif
                    </div>

                    <div class="col-6 text-center">
                        @if($game->awayTeam)
                            <span>
                                @if($game->awayTeam->featured_image)
                                    <img src="{{ $game->awayTeam->logoUrl() }}"
                                         style="width: 80px; height: 80px; object-fit: contain"
                                         alt="{{ $game->awayTeam->name }}"
                                         class="img-fluid m-auto">
                                @endif
                            </span>
                        @endif
                    </div>
                </div>

                <div class="row border-bottom mb-2 pb-2">
                    <div class="col-6 text-center">
                        <span class="font-weight-bold">{{ $game->homeTeam->name }}</span>
                    </div>
                    <div class="col-6 text-center">
                        <span class="font-weight-bold">{{ $game->awayTeam->name }}</span>
                    </div>
                </div>

                {!! Form::model($game, ['route' => ['mod.games.result.update', 'game' => $game->id], 'class' => 'was-validated', 'method' => 'patch']) !!}

                <div class="form-row">

                    <div class="form-group col-4 offset-1">
                        <label for="result[home_team_score]">{{ __('forms.mod.games.home_team.label') }}</label>
                        {!! Form::number('result[home_team_score]', null, [
                            'class' => 'form-control text-center form-control-lg',
                            'required' => true,
                            'autofocus' => true,
                        ]) !!}
                        @include('forms.input-error', ['name' => 'result.home_team_score'])
                    </div>

                    <div class="form-group col-4 offset-2">
                        <label for="result[away_team_score]">{{ __('forms.mod.games.away_team.label') }}</label>
                        {!! Form::number('result[away_team_score]', null, [
                            'class' => 'form-control text-center form-control-lg',
                            'required' => true,
                        ]) !!}
                        @include('forms.input-error', ['name' => 'result.away_team_score'])
                    </div>

                </div>

                <div class="text-center mb-2">
                    <button type="button" class="btn btn-primary btn-sm add-goal-scorer-input">
                        {{ __('forms.mod.games._add_goal_scorer') }}
                    </button>
                </div>

                <script>
                    let addedGoalScorers = 0;
                </script>

                <ul class="goal-scorers-list list-group list-group-flush mb-2">
                    <!-- Placeholder -->
                    <li class="list-group-item p-2 d-none">

                        <div class="form-row align-items-center">

                            <div class="form-group col-8 mb-0">
                                {!! Form::select('goalScorers[x][player_id]', $inputScorers, null, [
                                    'class' => 'form-control',
                                    ]) !!}
                            </div>

                            <div class="form-check col-3 text-right first-goal-scorer-radio-button-cont">
                                {!! Form::radio('first_goal', 'x', null, [
                                    'id' => 'first_goal_x',
                                    'class' => 'form-check-input'
                                    ]) !!}
                                <label for="first_goal_x" class="form-check-label">
                                    <span>{{ __('forms.mod.games.first_goal_scorer.label') }}</span>
                                </label>
                            </div>

                            <div class="col-1">
                                <button type="button" class="btn btn-outline-dark btn-sm text-right remove-goal-scorer-input">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>

                        </div>

                    </li>


                    @if(count((array)old('goalScorers')) > 0)

                        @foreach(old('goalScorers') as $key => $goalScorer)
                            @if($key === 'x')
                                @continue
                            @endif

                                <li class="list-group-item p-2">

                                    <div class="form-row align-items-center">

                                        <div class="form-group col-8 mb-0">
                                            {!! Form::select('goalScorers[' . $key . '][player_id]', $inputScorers, null, [
                                                'class' => 'form-control',
                                                'required' => 'true',
                                            ]) !!}
                                        </div>

                                        <div class="form-check col-3 text-right first-goal-scorer-radio-button-cont">
                                            {!! Form::radio('first_goal', $key, null, [
                                                'id' => 'first_goal_' . $key . '',
                                                'class' => 'form-check-input'
                                                ]) !!}
                                            <label for="first_goal_{{ $key }}" class="form-check-label">
                                                <span>{{ __('forms.mod.games.first_goal_scorer.label') }}</span>
                                            </label>
                                        </div>

                                        <div class="col-1">
                                            <button type="button" class="btn btn-outline-dark btn-sm text-right remove-goal-scorer-input">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>

                                    </div>

                                </li>

                            <script>
                                addedGoalScorers++;
                            </script>
                        @endforeach

                    @else

                        @foreach($game->goalScorers as $key => $goalScorer)

                            <li class="list-group-item p-2">

                                <div class="form-row align-items-center">

                                    <div class="form-group col-8 mb-0">
                                        {!! Form::hidden('goalScorers[' . $key . '][id]') !!}
                                        {!! Form::select('goalScorers[' . $key . '][player_id]', $inputScorers, null, [
                                            'class' => 'form-control',
                                            'required' => 'true',
                                        ]) !!}
                                    </div>

                                    <div class="form-check col-3 text-right first-goal-scorer-radio-button-cont">
                                        {!! Form::radio('first_goal', $key, $goalScorer->is_first_goal, [
                                            'id' => 'first_goal_' . $key . '',
                                            'class' => 'form-check-input'
                                            ]) !!}
                                        <label for="first_goal_{{ $key }}" class="form-check-label">
                                            <span>{{ __('forms.mod.games.first_goal_scorer.label') }}</span>
                                        </label>
                                    </div>

                                    <div class="col-1">
                                        <button type="button" class="btn btn-outline-dark btn-sm text-right remove-goal-scorer-input">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>

                                </div>

                            </li>

                            <script>
                                addedGoalScorers++;
                            </script>
                        @endforeach

                    @endif


                </ul>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">{{ __('forms.mod.games._submit') }}</button>

                    <a href="{{ route('mod.games.index') }}" class="btn btn-danger">{{ __('forms.cancel') }}</a>
                </div>

                {!! Form::close() !!}

            </div>

        </div>

    </div>

@endsection

@push('scripts-foot')
    <script>
        $(document).on('click', '.add-goal-scorer-input', function (e) {
            e.preventDefault();
            addedGoalScorers++;

            let $listContainer = $('.goal-scorers-list');
            let $listItemCloned = cloneAndAppendListItem($listContainer, addedGoalScorers, 'goalScorers[x]', true);
            // Adjust radio button identifiers
            let $radioButtonCont = $listItemCloned.find('.first-goal-scorer-radio-button-cont');

            let $input = $radioButtonCont.find(':input');
            $input.prop('id', $input.prop('id').replace('x', -addedGoalScorers));
            $input.val(-addedGoalScorers);
            $input.prop('required', true);

            let $label = $radioButtonCont.find('label');

            $label.prop('for', $label.prop('for').replace('x', -addedGoalScorers));
        });

        $(document).on('dblclick', '.remove-goal-scorer-input', function (e) {
            e.stopPropagation();
            deleteListItem($(this).closest("li"));
        });
    </script>
@endpush