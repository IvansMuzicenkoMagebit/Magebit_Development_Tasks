<?php
use Magento\Framework\Component\ComponentRegistrar;

//Module registration
ComponentRegistrar::register(
    ComponentRegistrar::THEME,
    'frontend/Magebit/learning',
    __DIR__
);
