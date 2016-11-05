#!/usr/bin/env ruby
# -*- coding: utf-8 -*-

require 'json'
require 'yaml'
print YAML::load(STDIN.read).to_json
