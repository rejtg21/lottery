<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@lang('lottery.page.title')</title>

    <!-- Fonts -->
    <link href="{{asset('dist/css/app.css')}}" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div class = "container"> 
      <div class = "d-flex justify-content-center">
        <h1>@lang('lottery.head.title')</h1>
      </div>
      <div class = "row">
        <p>@lang('lottery.head.description')</p>
      </div>
      <hr class="clearfix">
      <div class = "row">
        <p>@lang('lottery.instruction', [
          'min' => $numbers['min'],
          'max' => $numbers['max']
        ])
        </p>
      </div>
      <div class = "row">
          <form>
              <button id="generateBtn" type="button" class="btn btn-primary" title="@lang('lottery.form.button.generate.title')">
                @lang('lottery.form.button.generate.name')</button>

              <div id ="randomNumbers" class="d-none">
                <hr class="clearfix">
                <div class = "row">
                  <h3>@lang('lottery.form.title.generated')</h3>
                </div>
                <div class="d-flex flex-row">
                  <div class="form-group">
                    <label for="lottery1">@lang('lottery.form.input.firstNumber.label')</label>
                    <input type="text" class="form-control" id="lottery1" placeholder="@lang('lottery.form.input.firstNumber.placeholder', [
                      'min' => $numbers['min'],
                      'max' => $numbers['max']
                    ])">
                  </div>
                  <div class="form-group">
                    <label for="lottery2">@lang('lottery.form.input.secondNumber.label')</label>
                    <input type="text" class="form-control" id="lottery2" placeholder="@lang('lottery.form.input.secondNumber.placeholder', [
                      'min' => $numbers['min'],
                      'max' => $numbers['max']
                    ])">
                  </div>
                  <div class="form-group">
                    <label for="lottery3">@lang('lottery.form.input.thirdNumber.label')</label>
                    <input type="text" class="form-control" id="lottery3" placeholder="@lang('lottery.form.input.thirdNumber.placeholder', [
                      'min' => $numbers['min'],
                      'max' => $numbers['max']
                    ])">
                  </div>
                </div>
                <button id="confirmBtn" type="button" class="btn btn-success" title="@lang('lottery.form.button.confirm.title')">
                    @lang('lottery.form.button.confirm.name')</button>
    
              </div>
            </form>
      </div>
    </div>
  </body>
  <script type="text/javascript" src="{{asset('dist/js/app.js')}}"></script>
</html>
