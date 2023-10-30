
<div id="city_wrapper" class="col-sm-6">
    <select id="city" class="form-control" name="city">
        @foreach(\App\Models\City::all() as $item)
            <option @if(!empty($address)&& ($address->city == $item->id))
                    selected
                    @endif  value="{{$item->id}}">
                {{$item['text_'.App::getLocale()]}}
            </option>
        @endforeach
    </select>
</div>
<div class="col-sm-6">
    <div class="formItem">
        <input id="naselenny_punkt" class="form-control" type="text"
               name="naselenny_punkt"
               placeholder="@lang('Profile.naselenny_punkt')"
               value="{{(!empty($address))?$address->naselenny_punkt:''}}">
    </div>
</div>
<div class="col-sm-6">
    <div id="street_wrapper" class="formItem">
        <input class="form-control" type="text" id="street" name="street"
               placeholder="@lang('Profile.street')"
               value="{{(!empty($address))?$address->street:''}}">
        @error('street')
        <span class="invalid-feedback" role="alert">
                                                        <strong>* {{ $message }}</strong>
                                                    </span>
        @enderror
    </div>
</div>
<div class="col-sm-6">
    <div id="home_wrapper" class="formItem">
        <input class="form-control" type="text" id="home" name="home"
               placeholder="@lang('Profile.home')"
               value="{{(!empty($address))?$address->home:''}}">
        @error('home')
        <span class="invalid-feedback" role="alert">
                                                        <strong>* {{ $message }}</strong>
                                                    </span>
        @enderror
    </div>
</div>
<div class="col-sm-6">
    <div class="formItem">
        <input id="podezd" class="form-control" type="text" name="podezd"
               placeholder="@lang('Profile.podezd')"
               value="{{(!empty($address))?$address->podezd:''}}">
    </div>
</div>
<div class="col-sm-6">
    <div class="formItem">
        <input id="kvartira" class="form-control" type="text"
               name="kvartira"
               placeholder="@lang('Profile.kvartira')"
               value="{{(!empty($address))?$address->kvartira:''}}">
    </div>
</div>
<div class="col-sm-6">
    <div class="formItem">
        <input id="post_index" class="form-control" type="text"
               name="post_index"
               placeholder="@lang('Profile.post_index')"
               value="{{(!empty($address))?$address->post_index:''}}">
        @error('post_index')
        <span class="invalid-feedback" role="alert">
                                                        <strong>* {{ $message }}</strong>
                                                    </span>
        @enderror
    </div>
</div>
