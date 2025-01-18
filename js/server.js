const express = require('express');
const bodyParser = require('body-parser');
const nodemailer = require('nodemailer');

const app = express();
const port = 3000; // Choose a port for your server

// Middleware to parse JSON and url-encoded data
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

// Endpoint for handling email subscriptions
app.post('/subscribe', async (req, res) => {
    const { email } = req.body;

    // Replace these values with your email and SMTP server details
    const transporter = nodemailer.createTransport({
        service: 'gmail',
        auth: {
            user: 'moddySaido2018@gmail.com',
            pass: 'nopassword',
        },
    });

    const mailOptions = {
        from: 'moddySaido2018@gmail.com',
        to: 'admin@quickmart.com',
        subject: 'New Newsletter Subscription',
        text: `New subscriber: ${email}`,
    };

    try {
        await transporter.sendMail(mailOptions);
        res.status(200).send('Subscription successful!');
    } catch (error) {
        console.error(error);
        res.status(500).send('Internal Server Error');
    }
});

app.listen(port, () => {
    console.log(`Server is running on port ${port}`);
});
