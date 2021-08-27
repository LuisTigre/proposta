<template>
  
  <div class="modal fade col-md-12" v-bind:id="nome" tabindex="-1" role="dialog">
  <div class="modal-dialog dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">{{titulo}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <slot></slot>
      </div>
      <div class="modal-footer">
        <slot name="botoes"></slot>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</template>

<script>
    export default {
      props:['nome','titulo']

    }
</script>
