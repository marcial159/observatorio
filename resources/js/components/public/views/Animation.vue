<template lang="">
    <div class="display-block position-relative w-100" style="min-height: 350px">
        <img class="position-absolute base" :src="'/assets/img/landing2.svg'" alt="">
        <!-- <img class="position-absolute atom" :src="'/assets/img/atom.svg'" alt="">
        <img class="position-absolute hand" :src="'/assets/img/hand.svg'" alt="">
        <img class="position-absolute circle" :src="'/assets/img/circle.svg'" alt="">
        <img class="position-absolute circle2" :src="'/assets/img/circle.svg'" alt="">
        <img class="position-absolute eye" :src="'/assets/img/eye.svg'" alt="">
        <img class="position-absolute eye2" :src="'/assets/img/eye.svg'" alt=""> -->
    </div>
</template>
<style type="text/css">
@keyframes animName
{
    0%
    {
        transform: rotate(0deg);
    }
    100%
    {
        transform: rotate(360deg);
    }
}

@keyframes animName
{
    0%
    {
        transform: rotate(0deg);
    }
    100%
    {
        transform: rotate(360deg);
    }
}

@keyframes hand{
    0%{
        transform-origin: center; 
        transform:rotate(0deg)
    }
    25%{
        transform-origin: center; 
        transform:rotate(2deg);
    }
    50%{
        transform-origin: center; 
        transform:rotate(-3deg)
    }
    75%{
        transform-origin: center; 
        transform:rotate(2deg);
    }
    100%{
        transform-origin: center; 
        transform:rotate(0deg)
    }
}

.base
{
    left: 0px;
    right: 0px;
    top: 0px;
    bottom: 0px;
    margin: auto;
}

.atom
{
    right: 15%;
    top: 40%;
}

.circle
{
    left: 200px;
    top: 41%;
    width: 55px;
    transform-origin: center center;
    animation: animName 10s linear infinite;
}

.circle2
{
    left: 25%;
    top: 55%;
    transform-origin: center center;
    width: 30px;
    animation: animName 10s linear infinite;
}

.hand
{
    left: 52.7%;
    top: 26%;
    transform: rotate(90deg);    
    animation: hand 4s ease-in-out 0s infinite
}

.eye
{
    left: 39%;
    top: 30%;
}

.eye2
{
    left: 42%;
    top: 28%;
}

.str0
{
    position: relative;
}

</style>