<div id="skills" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
       <form method="post" action="{{route('freelancer.add.skill')}}">
           @csrf
           <select name="skill_id" required>
               <option disabled selected>Select</option>
               @foreach($data['skills'] as $skill)
               <option value="{{$skill->id}}" >{{$skill->name}}</option>
               @endforeach
           </select>
           <button type="submit" class="uk-button uk-button-primary">Add Skill</button>
       </form>
    </div>
</div>