@if($hasTranslatable)<div class="row form-inline" style="padding-bottom: 10px;" v-cloak>
    <div :class="{'col-11 text-right': !isFormLocalized, 'col text-center': isFormLocalized }">
        <small>Currently editing <strong>@@{{ this.defaultLocale.toUpperCase() }} (default)</strong> translation<span v-if="!isFormLocalized && otherLocales.length > 1"> (@@{{ otherLocales.length }} more can be managed)</span><span v-if="!isFormLocalized"> | <a href="#" @click.prevent="showLocalization">manage translations</a></span></small>
    </div>
    <div class="col text-center" v-if="isFormLocalized" v-cloak>
        <small>Choose translation to edit:
            <select class="form-control" v-model="currentLocale">
                <option v-for="locale in otherLocales" :value="locale">@@{{ locale.toUpperCase() }}</option>
            </select> |
            <a href="#" @click.prevent="hideLocalization">hide</a>
        </small>
    </div>
</div>
@endif

@foreach($columns as $col)@if($col['name'] == 'password')<div class="form-group row" :class="{'has-danger': errors.has('{{ $col['name'] }}'), 'has-success': this.fields.{{ $col['name'] }} && this.fields.{{ $col['name'] }}.valid }">
    <label for="{{ $col['name'] }}" class="col-md-3 col-form-label text-md-right">{{ ucfirst($col['name']) }}</label>
    <div class="col-md-9 col-xl-8">
        <input type="password" v-model="form.{{ $col['name'] }}" v-validate="'{{ implode('|', $col['frontendRules']) }}'" class="form-control" :class="{'form-control-danger': errors.has('{{ $col['name'] }}'), 'form-control-success': this.fields.{{ $col['name'] }} && this.fields.{{ $col['name'] }}.valid}" id="{{ $col['name'] }}" name="{{ $col['name'] }}" placeholder="{{ ucfirst($col['name']) }}">
        <div v-if="errors.has('{{ $col['name'] }}')" class="form-control-feedback" v-cloak>{{'@{{'}} errors.first('{{ $col['name'] }}') }}</div>
    </div>
</div>

<div class="form-group row" :class="{'has-danger': errors.has('{{ $col['name'] }}_confirmation'), 'has-success': this.fields.{{ $col['name'] }}_confirmation && this.fields.{{ $col['name'] }}_confirmation.valid }">
    <label for="{{ $col['name'] }}_confirmation" class="col-md-3 col-form-label text-md-right">{{ ucfirst($col['name']) }} Confirmation</label>
    <div class="col-md-9 col-xl-8">
        <input type="password" v-model="form.{{ $col['name'] }}_confirmation" v-validate="'{{ implode('|', $col['frontendRules']) }}'" class="form-control" :class="{'form-control-danger': errors.has('{{ $col['name'] }}_confirmation'), 'form-control-success': this.fields.{{ $col['name'] }}_confirmation && this.fields.{{ $col['name'] }}_confirmation.valid}" id="{{ $col['name'] }}_confirmation" name="{{ $col['name'] }}_confirmation" placeholder="{{ ucfirst($col['name']) }}">
        <div v-if="errors.has('{{ $col['name'] }}_confirmation')" class="form-control-feedback" v-cloak>{{'@{{'}} errors.first('{{ $col['name'] }}') }}</div>
    </div>
</div>
@elseif($col['name'] == 'language')<div class="form-group row" :class="{'has-danger': errors.has('{{ $col['name'] }}'), 'has-success': this.fields.{{ $col['name'] }} && this.fields.{{ $col['name'] }}.valid }">
    <label for="{{ $col['name'] }}" class="col-md-3 col-form-label text-md-right">{{ ucfirst($col['name']) }}</label>
    <div class="col-md-9 col-xl-8">
        <select v-model="form.{{ $col['name'] }}" v-validate="'required'" class="form-control" :class="{'form-control-danger': errors.has('{{ $col['name'] }}'), 'form-control-success': this.fields.{{ $col['name'] }} && this.fields.{{ $col['name'] }}.valid}" id="{{ $col['name'] }}" name="{{ $col['name'] }}">
            @@foreach  ($locales as $locale)
                @php echo '<option value="@{{ $locale }}"@{{ $locale == old(\''.$col['name'].'\', \'\') ? \' selected="selected"\' : null }}>@{{ $locale }}</option>'; @endphp

                @@endforeach
        </select>
        <div v-if="errors.has('{{ $col['name'] }}')" class="form-control-feedback" v-cloak>@@{{ errors.first('@php echo $col['name']; @endphp') }}</div>
    </div>
</div>
@elseif($col['type'] == 'date')<div class="form-group row" :class="{'has-danger': errors.has('{{ $col['name'] }}'), 'has-success': this.fields.{{ $col['name'] }} && this.fields.{{ $col['name'] }}.valid }">
    <label for="{{ $col['name'] }}" class="col-md-3 col-form-label text-md-right">{{ ucfirst($col['name']) }}</label>
    <div class="col-sm-6">
        <datetime v-model="form.{{ $col['name'] }}" :config="datePickerConfig" v-validate="'{{ implode('|', $col['frontendRules']) }}'" class="flatpickr" :class="{'form-control-danger': errors.has('{{ $col['name'] }}'), 'form-control-success': this.fields.{{ $col['name'] }} && this.fields.{{ $col['name'] }}.valid}" id="{{ $col['name'] }}" name="{{ $col['name'] }}" placeholder="Select a date"></datetime>
        <div v-if="errors.has('{{ $col['name'] }}')" class="form-control-feedback" v-cloak>{{'@{{'}} errors.first('{{ $col['name'] }}') }}</div>
    </div>
</div>
@elseif($col['type'] == 'time')<div class="form-group row" :class="{'has-danger': errors.has('{{ $col['name'] }}'), 'has-success': this.fields.{{ $col['name'] }} && this.fields.{{ $col['name'] }}.valid }">
    <label for="{{ $col['name'] }}" class="col-md-3 col-form-label text-md-right">{{ ucfirst($col['name']) }}</label>
    <div class="col-sm-6">
        <datetime v-model="form.{{ $col['name'] }}" :config="timePickerConfig" v-validate="'{{ implode('|', $col['frontendRules']) }}'" class="flatpickr" :class="{'form-control-danger': errors.has('{{ $col['name'] }}'), 'form-control-success': this.fields.{{ $col['name'] }} && this.fields.{{ $col['name'] }}.valid}" id="{{ $col['name'] }}" name="{{ $col['name'] }}" placeholder="Select a time"></datetime>
        <div v-if="errors.has('{{ $col['name'] }}')" class="form-control-feedback" v-cloak>{{'@{{'}} errors.first('{{ $col['name'] }}') }}</div>
    </div>
</div>
@elseif($col['type'] == 'datetime')<div class="form-group row" :class="{'has-danger': errors.has('{{ $col['name'] }}'), 'has-success': this.fields.{{ $col['name'] }} && this.fields.{{ $col['name'] }}.valid }">
    <label for="{{ $col['name'] }}" class="col-md-3 col-form-label text-md-right">{{ ucfirst($col['name']) }}</label>
    <div class="col-sm-6">
        <datetime v-model="form.{{ $col['name'] }}" :config="datetimePickerConfig" v-validate="'{{ implode('|', $col['frontendRules']) }}'" class="flatpickr" :class="{'form-control-danger': errors.has('{{ $col['name'] }}'), 'form-control-success': this.fields.{{ $col['name'] }} && this.fields.{{ $col['name'] }}.valid}" id="{{ $col['name'] }}" name="{{ $col['name'] }}" placeholder="Select a datetime"></datetime>
        <div v-if="errors.has('{{ $col['name'] }}')" class="form-control-feedback" v-cloak>{{'@{{'}} errors.first('{{ $col['name'] }}') }}</div>
    </div>
</div>
@elseif($col['type'] == 'text')<div class="form-group row" :class="{'has-danger': errors.has('{{ $col['name'] }}'), 'has-success': this.fields.{{ $col['name'] }} && this.fields.{{ $col['name'] }}.valid }">
    <label for="{{ $col['name'] }}" class="col-md-3 col-form-label text-md-right">{{ ucfirst($col['name']) }}</label>
    <div class="col-md-9 col-xl-8">
        <div>
            <textarea v-model="form.{{ $col['name'] }}" v-validate="'{{ implode('|', $col['frontendRules']) }}'" class="hidden-xs-up" id="{{ $col['name'] }}" name="{{ $col['name'] }}"></textarea>
            <quill-editor v-model="form.{{ $col['name'] }}" :options="wysiwygConfig" />
        </div>
        <div v-if="errors.has('{{ $col['name'] }}')" class="form-control-feedback" v-cloak>{{'@{{'}} errors.first('{{ $col['name'] }}') }}</div>
    </div>
</div>
@elseif($col['type'] == 'boolean')<div class="form-check row" :class="{'has-danger': errors.has('{{ $col['name'] }}'), 'has-success': this.fields.{{ $col['name'] }} && this.fields.{{ $col['name'] }}.valid }">
    <div class="col-md-9 col-xl-8 offset-md-3">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" v-model="form.{{ $col['name'] }}" v-validate="'{{ implode('|', $col['frontendRules']) }}'" data-vv-name="{{ $col['name'] }}"  name="{{ $col['name'] }}_fake_element">
            <input type="hidden" name="{{ $col['name'] }}" :value="form.{{ $col['name'] }}">
            {{ ucfirst($col['name']) }}?
            <div v-if="errors.has('{{ $col['name'] }}')" class="form-control-feedback" v-cloak>{{'@{{'}} errors.first('{{ $col['name'] }}') }}</div>
        </label>
    </div>
</div>
@elseif($col['type'] == 'json')<div class="row">
    @@foreach($locales as $locale)
        <div class="col"@@if(!$loop->first) v-show="isFormLocalized && currentLocale == '@{{ $locale }}'" v-cloak @@endif>
            <div class="form-group row" :class="{'has-danger': errors.has('@{{ $locale }}_{{ $col['name'] }}'), 'has-success': this.fields.@{{ $locale }}_{{ $col['name'] }} && this.fields.@{{ $locale }}_{{ $col['name'] }}.valid }">
                <label for="@{{ $locale }}_{{ $col['name'] }}" class="col-md-3 col-form-label text-md-right">{{ ucfirst($col['name']) }}</label>
                <div class="col-md-9" :class="{'col-xl-8': !isFormLocalized }">
                    @if(in_array($col['name'], $translatableTextarea))<div>
                        <textarea v-model="form.{{ $col['name'] }}.@{{ $locale }}" @@if($loop->first) v-validate="'{!! implode('|', $col['frontendRules']) !!}'" @@endif class="hidden-xs-up" id="@{{ $locale }}_{{ $col['name'] }}" name="@{{ $locale }}_{{ $col['name'] }}"></textarea>
                        <quill-editor v-model="form.{{ $col['name'] }}.@{{ $locale }}" :options="wysiwygConfig" />
                    </div>
                    @else<input type="text" v-model="form.{{ $col['name'] }}.@{{ $locale }}" @@if($loop->first) v-validate="'{!! implode('|', $col['frontendRules']) !!}'" @@endif class="form-control" :class="{'form-control-danger': errors.has('@{{ $locale }}_{{ $col['name'] }}'), 'form-control-success': this.fields.@{{ $locale }}_{{ $col['name'] }} && this.fields.@{{ $locale }}_{{ $col['name'] }}.valid }" id="@{{ $locale }}_{{ $col['name'] }}" name="@{{ $locale }}_{{ $col['name'] }}" placeholder="{{ ucfirst($col['name']) }}">
                    @endif<div v-if="errors.has('@{{ $locale }}_{{ $col['name'] }}')" class="form-control-feedback" v-cloak>@{{'{{'}} errors.first('@{{ $locale }}_{{ $col['name'] }}') }}</div>
                </div>
            </div>
        </div>
    @@endforeach
</div>
@else<div class="form-group row" :class="{'has-danger': errors.has('{{ $col['name'] }}'), 'has-success': this.fields.{{ $col['name'] }} && this.fields.{{ $col['name'] }}.valid }">
    <label for="{{ $col['name'] }}" class="col-md-3 col-form-label text-md-right">{{ ucfirst($col['name']) }}</label>
    <div class="col-md-9 col-xl-8">
        <input type="text" v-model="form.{{ $col['name'] }}" v-validate="'{{ implode('|', $col['frontendRules']) }}'" class="form-control" :class="{'form-control-danger': errors.has('{{ $col['name'] }}'), 'form-control-success': this.fields.{{ $col['name'] }} && this.fields.{{ $col['name'] }}.valid}" id="{{ $col['name'] }}" name="{{ $col['name'] }}" placeholder="{{ ucfirst($col['name']) }}">
        <div v-if="errors.has('{{ $col['name'] }}')" class="form-control-feedback" v-cloak>{{'@{{'}} errors.first('{{ $col['name'] }}') }}</div>
    </div>
</div>
@endif

@endforeach

@if (count($relations))
@if (count($relations['belongsToMany']))
@foreach($relations['belongsToMany'] as $belongsToMany)<div class="form-group row" :class="{'has-danger': errors.has('{{ $belongsToMany['related_table'] }}'), 'has-success': this.fields.{{ $belongsToMany['related_table'] }} && this.fields.{{ $belongsToMany['related_table'] }}.valid }">
    <label for="{{ $belongsToMany['related_table'] }}" class="col-md-3 col-form-label text-md-right">{{ $belongsToMany['related_model_name_plural'] }}</label>
    <div class="col-md-9 col-xl-8">
        <select v-model="form.{{ $belongsToMany['related_table'] }}" v-validate="'required'" class="form-control" :class="{'form-control-danger': errors.has('{{ $belongsToMany['related_table'] }}'), 'form-control-success': this.fields.{{ $belongsToMany['related_table'] }} && this.fields.{{ $belongsToMany['related_table'] }}.valid}" id="{{ $belongsToMany['related_table'] }}" name="{{ $belongsToMany['related_table'] }}[]" multiple>
            @@foreach  (${{ $belongsToMany['related_table'] }} as ${{ $belongsToMany['related_model_variable_name'] }})
                @php echo '<option value="@{{ $'.$belongsToMany['related_model_variable_name'].'->id }}"@{{ array_key_exists($'.$belongsToMany['related_model_variable_name'].'->id, old(\''.$belongsToMany['related_table'].'\', [])) ? \' selected="selected"\' : null }}>@{{ $'.$belongsToMany['related_model_variable_name'].'->name }}</option>'; @endphp

            @@endforeach
        </select>
        <div v-if="errors.has('{{ $belongsToMany['related_table'] }}')" class="form-control-feedback" v-cloak>@@{{ errors.first('@php echo $belongsToMany['related_table']; @endphp') }}</div>
    </div>
</div>
@endforeach
@endif
@endif