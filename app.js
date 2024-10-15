const express = require('express');
const session = require('express-session');
const passport = require('passport');
const OIDCStrategy = require('passport-azure-ad').OIDCStrategy;

const app = express();

const config = {
  clientID: 'YOUR_CLIENT_ID',
  clientSecret: 'YOUR_CLIENT_SECRET',
  callbackURL: 'https://demo.shrichandragroup.com/auth/callback',
  tenantID: 'YOUR_TENANT_ID',
  identityMetadata: `https://login.microsoftonline.com/${YOUR_TENANT_ID}/v2.0/.well-known/openid-configuration`,
  responseType: 'code',
  responseMode: 'query',
  scope: ['openid', 'profile', 'email'],
};

passport.use(new OIDCStrategy(config, (iss, sub, profile, accessToken, refreshToken, done) => {
  if (!profile.oid) {
    return done(new Error("No OID found"), null);
  }
  // User profile is returned
  return done(null, profile);
}));

passport.serializeUser((user, done) => {
  done(null, user);
});

passport.deserializeUser((obj, done) => {
  done(null, obj);
});

app.use(session({ secret: 'your_secret_key', resave: true, saveUninitialized: false }));
app.use(passport.initialize());
app.use(passport.session());

app.get('/login', passport.authenticate('azuread-openidconnect', { failureRedirect: '/' }));

app.get('/auth/callback',
  passport.authenticate('azuread-openidconnect', { failureRedirect: '/' }),
  (req, res) => {
    res.redirect('/');
  }
);

app.get('/', (req, res) => {
  if (req.isAuthenticated()) {
    res.send(`Hello ${req.user.displayName}`);
  } else {
    res.send('<a href="/login">Sign in with Microsoft</a>');
  }
});

const port = process.env.PORT || 3000;
app.listen(port, () => {
  console.log(`Server running on http://localhost:${port}`);
});
