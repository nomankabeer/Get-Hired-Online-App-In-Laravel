<div id="skills_update" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
       <form method="post" action="{{route('freelancer.update.skill')}}">
           @csrf
           @method('put')
           <input type="hidden" name="id" id="id">
           <select name="skill_id" required>
               @foreach($data['skills'] as $skill)
               <option class="editSkill_{{$skill->id}}" value="{{$skill->id}}" >{{$skill->name}}</option>
               @endforeach
           </select>
           <button type="submit" class="uk-button uk-button-primary">Update Skill</button>
       </form>
    </div>
</div>
@push('script')
    <script>
        function edit_data(htmlid){
            var id = $('#'+htmlid).attr('edit_record_id');
            $('.editSkill_'+id).attr('selected' , 'selected');
            $('#id').val(id);
            }
    </script>
@endpush