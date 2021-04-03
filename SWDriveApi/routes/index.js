var express = require('express');
var router = express.Router();

//my code

const multer = require('multer');
// Google drive code
const path = require('path');
const fs = require('fs');
const { google } = require('googleapis');
const CLIENT_ID = '365946735153-o3shljqu923qe6tkqc135l1uenu6hlnn.apps.googleusercontent.com';
const CLIENT_SECRET = 'NJRYHVTt-YzlEFQkXzYAoEQk';
const REDIRECT_URI = 'https://developers.google.com/oauthplayground';
const REFRESH_TOKEN = '1//04yymaNHFXYZpCgYIARAAGAQSNwF-L9IrGtMwDZ8igmBfcoNO2QzCkuiOrL3VMN-Hr5N75i4aX4JF4TxxhbddIWHyfPAnGSLk5w4';

const oauth2Client = new google.auth.OAuth2(
  CLIENT_ID,
  CLIENT_SECRET,
  REDIRECT_URI
);
oauth2Client.setCredentials({ refresh_token: REFRESH_TOKEN });
const drive = google.drive({
  version: 'v3',
  auth: oauth2Client
});

const mime = require('mime-types')
// const filePath = path.join(__dirname, 'Android-Logo.png');


function uploadFile(file,fid) {
  try {
    let folderId = fid;
    const response = drive.files.create({
      requestBody: {
        name: file,
        mimeType: mime.lookup(file),
        parents: [folderId]
      },
      media: {
        mimeType: mime.lookup(file),
        body: fs.createReadStream(file)
      }
    });
    console.log(response.data);
  } catch (error) {
    console.log(error.message);
  }
}


const process = require('process');
const { exit } = require('process');
const { Server } = require('http');
const { restart } = require('nodemon');

/* GET home page. */
process.chdir('../admin/TES/GeneratedTES');
router.get('/upload', function (req, res, next) {
try{
  
  console.log(process.cwd());
  let testFolder = process.cwd();
  fs.readdir(testFolder, (err, files,) => {
    files.forEach(file => {
      // console.log(file);
      fid = "1bBOK6uUSC3zcC0iu6xD_Zw5ej7KnyXoD";
      uploadFile(file,fid);
    });
  });
  fs.close();
}catch(err){
  restart;
}
res.render('index', { title: 'Syllabus Warehouse' });
});

module.exports = router;
