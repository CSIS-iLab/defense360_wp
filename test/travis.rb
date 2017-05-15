#!/usr/bin/env ruby
result = `sass wp-content/themes/defense360/sass/style.scss wp-content/themes/defense360/style.css`
raise result unless $?.to_i == 0
raise "When compiled the module should output some CSS" unless File.exists?('style.css')
puts "Regular compile worked successfully"