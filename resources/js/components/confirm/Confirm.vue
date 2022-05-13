<template>
    <span></span>
</template>

<script>
    export default {
        props: ["title", "text", "icon", "buttons"],
        methods: {
            alert: function() {
                swal({
                    title: this.title,
                    text: this.text,
                    icon: this.icon,
                    buttons: JSON.parse(this.buttons)
                });
            }
        },
        created: function(){
            swal(this.title, this.text, this.icon)
        }
    };
</script>