<!-- Modal Create TV Show -->
<div class="modal fade fade modal-fullscreen-sm-down" id="modalCreateTVShow" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Insert new TV Show</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="bodyModalCreateTVShow">
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="btnCreateTVShow" class="btn btn-primary">Add tv show</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal VIEW Tv show -->
<div class="modal fade fade modal-fullscreen-sm-down" id="modalViewTVShow" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tvshowTitle"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="bodyModalViewTVShow">
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal VIEW ACTOR DETAILS -->
<div class="modal fade fade modal-fullscreen-sm-down" id="modalViewActor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="actorTitle"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="bodyModalViewActor">
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Create ACTOR  -->
<div class="modal fade fade modal-fullscreen-sm-down" id="modalCreateActor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Insert new Actor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="bodyModalCreateActor">
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="btnCreateActor" class="btn btn-primary">Add Actor</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal ASSOCIATE ACTOR TO TV SHOW  -->
<div class="modal fade fade modal-fullscreen-sm-down" id="modalAssociateActorTVShow" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Actor to TV show</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="bodyModalActorTVshow">
     
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-target="#modalViewActor" data-bs-toggle="modal">Back to actor</button>
        <button type="submit" id="btnAddActorTVShow" class="btn btn-primary">Add Actor to tv show</button>
      </div>
    </div>
  </div>
</div>