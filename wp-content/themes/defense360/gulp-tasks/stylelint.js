const { spawn } = require('child_process')
const config = require('../gulp.config.js')

function stylelint(done) {
  const glob = config.assets + config.sass.src + '/**/*.scss'
  const command = 'npx'
  const args = ['stylelint', glob]

  // If --fix was passed to gulp, add it to the arguments
  if (process.argv.includes('--fix')) {
    args.push('--fix')
  }

  console.log('Running stylelint command:', command, args.join(' '))

  // Use spawn so that output is streamed to the terminal
  const child = spawn(command, args, { shell: true })

  child.stdout.on('data', (data) => {
    process.stdout.write(data)
  })

  child.stderr.on('data', (data) => {
    process.stderr.write(data)
  })

  child.on('close', (code) => {
    if (code !== 0) {
      console.warn(
        'Stylelint reported errors (exit code',
        code,
        '), continuing...'
      )
    }
    done()
  })
}

module.exports = stylelint
