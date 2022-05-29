<?php

function success(string $message)
{
    request()->session()->flash('flash.banner', $message);
    request()->session()->flash('flash.bannerStyle', 'success');
}

function error(string $message)
{
    request()->session()->flash('flash.banner', $message);
    request()->session()->flash('flash.bannerStyle', 'danger');
}

function ship(string $shippingCountry, string $status): bool
{
    if ($shippingCountry === 'GB') {
        return false;
    }

    if ($status !== 'Valid') {
        return false;
    }

    return true;
}
