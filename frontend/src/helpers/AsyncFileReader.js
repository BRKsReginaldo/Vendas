export default class AsyncFileReader {
  constructor() {
    this.reader = new FileReader()
  }

  readAs(file, format) {
    return new Promise((resolve, reject) => {
      const methodName = `readAs${format}`

      try {
        this.reader.onload = ev => {
          return resolve(ev.target.result)
        }

        this.reader[methodName](file)
      } catch(e) {
        return reject(e)
      }
    })
  }

  readAsDataURL(file) {
    return this.readAs(file, 'DataURL')
  }

  readAsArrayBuffer(file) {
    return this.readAs(file, 'ArrayBuffer')
  }

  readAsBinaryString(file) {
    this.readAs(file, 'BinaryString')
  }

  readAsText(file) {
    this.readAs('Text')
  }
}